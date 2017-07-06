<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/10/17
 * Time: 12:14 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);
if (!empty($data)) {
    $patientVisit = new \Hudutech\Entity\PatientVisit();
    $patientVisit->setPatientId($data['id']);
    $patientVisit->setStatus('active');
    $patientVisitCtrl = new \Hudutech\Controller\PatientVisitController();
    $created = $patientVisitCtrl->create($patientVisit);
    // add patient to the queue

    if ($created) {
        \Hudutech\Controller\PatientController::addToQueue($data['id']);
        print_r(json_encode(array(
            "statusCode" => 200,
            "message" => "Patient added to visit list successfully"
        )));
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "internal server error occurred try again later"
        )));
    }
} else {
    print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "all fields required"
        )));
}