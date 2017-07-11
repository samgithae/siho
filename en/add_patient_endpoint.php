<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/9/17
 * Time: 7:13 AM
 */

require_once __DIR__.'/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);

$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == 'POST') {

    if (!empty($data)) {
        $patient = new \Hudutech\Entity\Patient();

        if (!empty($data['patientNo']) and
            !empty($data['fullName']) and
            !empty($data['patientType']) and
            !empty($data['sex']) and
            !empty($data['age'])and
            !empty($data['location'])
        ) {

            $patient->setPatientNo($data['patientNo']);
            $patient->setIdNo(null);
            $patient->setSurName($data['fullName']);
            $patient->setFirstName(null);
            $patient->setOtherName(null);
            $patient->setMaritalStatus(null);
            $patient->setPhoneNumber($data['phoneNumber']);
            $patient->setOccupation(null);
            $patient->setPatientType($data['patientType']);
            $patient->setSex($data['sex']);
            $patient->setAge($data['age']);
            $patient->setLocation($data['location']);

            $patientCtrl = new \Hudutech\Controller\PatientController();
            $created = $patientCtrl->create($patient);
            if ($created) {
                //add patient to visit list

                $patientVisit = new \Hudutech\Entity\PatientVisit();
                $patientVisit->setPatientId(\Hudutech\Controller\PatientController::getPatientId(date('Y')."-".$data['patientNo'])['id']);
                $patientVisit->setStatus("active");

                $patientVisitCtrl = new \Hudutech\Controller\PatientVisitController();
                $patientVisitCtrl->create($patientVisit);
                //add the patient to the queue
                \Hudutech\Controller\PatientController::addToQueue(\Hudutech\Controller\PatientController::getPatientId(date('Y')."-".$data['patientNo'])['id']);

                print_r(json_encode(array(
                    "statusCode" => 200,
                    "message" => "Patient registered successfully and was added to the Queue"
                )));
            } else {
                print_r(json_encode(
                    array(
                        "statusCode" => 500,
                        "message" => "error occurred while registering the patient please try again later"
                    )
                ));
            }
        } else {
            print_r(json_encode(
                array(
                    "statusCode" => 500,
                    "message" => "Error. all fields required"
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

if ($requestMethod == 'PUT') {
    if (!empty($data)) {
        $patient = new \Hudutech\Entity\Patient();

        if (!empty($data['patientNo']) and
            !empty($data['fullName']) and
            !empty($data['patientType']) and
            !empty($data['sex']) and
            !empty($data['age'])
            and
            !empty($data['location'])
        ) {

            $patient->setPatientNo($data['patientNo']);
            $patient->setIdNo(null);
            $patient->setSurName($data['fullName']);
            $patient->setFirstName(null);
            $patient->setOtherName(null);
            $patient->setMaritalStatus(null);
            $patient->setPhoneNumber($data['phoneNumber']);
            $patient->setOccupation(null);
            $patient->setPatientType($data['patientType']);
            $patient->setSex($data['sex']);
            $patient->setAge($data['age']);
            $patient->setLocation($data['location']);

            $patientCtrl = new \Hudutech\Controller\PatientController();
            $updated = $patientCtrl->update($patient, $data['id']);
            if ($updated) {
                print_r(json_encode(array(
                    "statusCode" => 201,
                    "message" => "Patient Info updated successfully"
                )));
            } else {
                print_r(json_encode(
                    array(
                        "statusCode" => 500,
                        "message" => "error occurred while updating the patient please try again later"
                    )
                ));
            }
        } else {
            print_r(json_encode(
                array(
                    "statusCode" => 500,
                    "message" => "Error. all fields required"
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

if ($requestMethod == 'DELETE') {
    if (!empty($data['id'])) {
        $deleted= \Hudutech\Controller\PatientController::delete($data['id']);
        if ($deleted) {
            print_r(json_encode(array(
                "statusCode" => 204,
                "message" => "Patient Deleted!"
            )));
        } else {
            print_r(json_encode(
                array(
                    "statusCode" => 500,
                    "message" => "error occurred while registering the patient please try again later"
                )
            ));
        }
    }
    else{
        print_r(json_encode(
            array(
                "statusCode" => 500,
                "message" => "Failed to fetch patient info!"
            )
        ));
    }
}