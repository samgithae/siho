<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/9/17
 * Time: 7:13 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);
$requestMethod=$_SERVER['REQUEST_METHOD'];
if($requestMethod=='POST') {

    if (!empty($data)) {

        $drug_prescriptions = new \Hudutech\Entity\DrugPrescription();

        if (!empty($data['patientId']) && !empty($data['drugName'])) {

            $prescription = (string)$data['prescription1'] . " * " . $data['prescription3'];
            $drug_prescriptions->setPatientId($data['patientId']);
            $drug_prescriptions->setDrugName($data['drugName']);
            $drug_prescriptions->setDrugType($data['drugType']);
            $drug_prescriptions->setQuantity($data['quantity']);
            $drug_prescriptions->setPrescription($prescription);
            $drug_prescriptions->setStatus("not_issued");

            $drug_prescriptionsCtrl = new \Hudutech\Controller\DrugPrescriptionController();


            $created = $drug_prescriptionsCtrl->create($drug_prescriptions);
            if ($created) {

                print_r(json_encode(array(
                    "statusCode" => 200,
                    "message" => "Information saved successfully"
                )));
            } else {
                print_r(json_encode(
                    array(
                        "statusCode" => 500,
                        "message" => "error occurred while adding, please try again later"
                    )
                ));
            }


        } else {
            print_r(json_encode(
                array(
                    "statusCode" => 500,
                    "message" => "Drug name cannot be blank."
                )
            ));
        }

    } else {
        print_r(json_encode(
            array(
                "statusCode" => 500,
                "message" => "no data supplied"
            )
        ));

    }
}
if($requestMethod=='DELETE')
{
    if(!empty($data))
    {
        $id = $data['id'];
        $deleted = $patientClinicalDrugCtrl = \Hudutech\Controller\DrugPrescriptionController::delete($id);

        if ($deleted) {
            print_r(json_encode(array(
                "statusCode" => 204,
                "message" => "Prescription  deleted."
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => " Internal Server Error occurred. Failed to delete prescription ."
            )));
        }
    }
}
