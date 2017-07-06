<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/9/17
 * Time: 7:13 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);

if(!empty($data)) {
    $clinical_notes= new \Hudutech\Entity\ClinicalNote();
    if( !empty($data['patientId']) && !empty($data['complaint']) ){

        $clinical_notes->setPatientId($data['patientId']);
        $clinical_notes->setComplaint($data['complaint']);
        $clinical_notes->setComplaintHistory($data['complaintHistory']);
        $clinical_notes->setFamilySocialHistory($data['familySocialHistory']);
        $clinical_notes->setPhysicalExamination($data['physicalExamination']);

        $clinicalNotesCtrl= new \Hudutech\Controller\ClinicalNoteController();
        $created = $clinicalNotesCtrl->create($clinical_notes);
        if ($created) {

            print_r(json_encode(array(
                "statusCode"=>200,
                "message"=>"Information saved successfully"
            )));
        }
        else{
            print_r(json_encode(
                array(
                    "statusCode"=>500,
                    "message"=>"error occurred while saving patient information please try again later"
                )
            ));
        }


    } else{
        print_r(json_encode(
            array(
                "statusCode"=>500,
                "message"=>"Current Complaints cannot be blank."
            )
        ));
    }

}
else{
    print_r(json_encode(
        array(
            "statusCode"=>500,
            "message"=>"no data supplied"
        )
    ));

}