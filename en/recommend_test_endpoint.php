<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/11/17
 * Time: 10:53 AM
 */

require_once __DIR__.'/../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == 'POST') {
    if (!empty($data)) {
        if (!empty($data['testId']) && !empty($data['patientId'])) {
            $patientClinicalTest = new \Hudutech\Entity\PatientClinicalTest();
            $patientClinicalTest->setClinicianId(null);
            $patientClinicalTest->setPatientId($data['patientId']);
            $patientClinicalTest->setTestId($data['testId']);
            $patientClinicalTest->setDescription(null);
            $patientClinicalTest->setPerformed(false);
            $patientClinicalTest->setTestResult(null);
            $today = date("Y-m-d");
            $patientClinicalTest->setCreatedAt($today);
            $patientClinicalTestCtrl = new \Hudutech\Controller\PatientClinicalTestController();

            $created = $patientClinicalTestCtrl->create($patientClinicalTest);
            if ($created) {
                print_r(json_encode(array(
                    "statusCode" => 200,
                    "message" => "Test Added."
                )));
            } else {
                print_r(json_encode(array(
                    "statusCode" => 500,
                    "message" => "Test Already added."
                )));
            }
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => "Failed to fetch required patient info"
            )));
        }
    }
}
elseif ($requestMethod == 'DELETE'){
    if (!empty($data)){
        $id = $data['id'];
        $deleted = $patientClinicalTestCtrl = \Hudutech\Controller\PatientClinicalTestController::delete($id);

        if ($deleted) {
            print_r(json_encode(array(
                "statusCode" => 204,
                "message" => "Test deleted."
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => " Internal Server Error occurred. Failed to delete test ."
            )));
        }
    }
    else{
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => " Internal Server Error occurred.Failed to fetch id"
        )));
    }
}