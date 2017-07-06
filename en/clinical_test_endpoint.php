<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/10/17
 * Time: 9:36 AM
 */
require_once __DIR__.'/../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestMethod == 'POST' && !empty($data)) {
    $clinicalTest = new \Hudutech\Entity\ClinicalTest();
    if (!empty($data['testName']) && !empty($data['cost'])) {
        $clinicalTest->setTestName($data['testName']);
        $clinicalTest->setCost($data['cost']);

        $clinicalTestCtrl = new \Hudutech\Controller\ClinicalTestController();
        $created = $clinicalTestCtrl->create($clinicalTest);
        if ($created) {
            print_r(json_encode(array(
                "statusCode" => 200,
                "message" => "Clinical Test Added Successfully"
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => " Internal Server error occurred. Test not added. Please try again later"
            )));
        }
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "all fields required"
        )));
    }
}

if ($requestMethod == 'PUT' && !empty($data)) {
    $clinicalTest = new \Hudutech\Entity\ClinicalTest();
    if (!empty($data['testName']) && !empty($data['cost']) && !empty($data['id'])) {
        $clinicalTest->setTestName($data['testName']);
        $clinicalTest->setCost($data['cost']);

        $clinicalTestCtrl = new \Hudutech\Controller\ClinicalTestController();
        $created = $clinicalTestCtrl->update($clinicalTest, $data['id']);
        if ($created) {
            print_r(json_encode(array(
                "statusCode" => 201,
                "message" => "Clinical Test updated Successfully"
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => " Internal Server error occurred. Test not updated. Please try again later"
            )));
        }
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "all fields required"
        )));
    }
}

if ($requestMethod == 'DELETE' && !empty($data)) {
    if (!empty($data['id'])) {
        $deleted = \Hudutech\Controller\ClinicalTestController::delete($data['id']);
        if ($deleted) {
            print_r(json_encode(array(
                "statusCode" => 204,
                "message" => "Clinical Test deleted."
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "message" => " Internal Server error occurred. Test not deleted. Please try again later"
            )));
        }
    }
}
