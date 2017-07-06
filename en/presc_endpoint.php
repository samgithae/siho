<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/18/17
 * Time: 6:54 PM
 */
require_once __DIR__.'/../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['id'])){
    $marked = \Hudutech\Controller\DrugPrescriptionController::markDrugUnavailable($data['id']);
    if ($marked) {
        print_r(json_encode(array(
            "statusCode"=>200,
            "message"=> "Marked Unavailable."
        )));
    }
    else{
        print_r(json_encode(array(
            "statusCode"=>500,
            "message"=>"Internal error occurred. Drug Not Marked as Unavailable"
        )));
    }
}else{
    print_r(json_encode(array(
        "statusCode"=>500,
        "message"=>"Internal error occurred. Failed to fetch drug info"
    )));
}