<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/12/17
 * Time: 8:35 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'PUT') {
    if (!empty($data['id']) && !empty($data['testResult'])) {
        $patientTestObj = \Hudutech\Controller\PatientClinicalTestController::getObject($data['id']);
        $patientTestObj->setClinicianId(rand(1, 10000));
        $patientTestObj->setDescription($data['description']);
        $patientTestObj->setTestResult($data['testResult']);
        $date = date('Y-m-d H:i:s');
        $patientTestObj->setUpdatedAt($date);
        $isPerformed = $patientTestObj->setPerformed(1);

        $patientTestCtrl = new \Hudutech\Controller\PatientClinicalTestController();
        $updated = $patientTestCtrl->update($patientTestObj, $data['id']);
        if ($updated) {
            print_r(json_encode(array(
                "statusCode" => 201,
                "message" => "Test Result Recorded successfully."
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => "Internal Server error occurred try again later."
            )));
        }
    }
    else{
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "Test Results Cannot be blank!."
        )));
    }
}else{
    print_r(json_encode(array(
        "statusCode" => 500,
        "message" => "invalid request method"
    )));
}