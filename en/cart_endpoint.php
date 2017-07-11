<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/18/17
 * Time: 10:06 AM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST') {

    if (!empty($data)) {

        if (!empty($data['inventoryId']) && !empty($data['qty'])) {
            $price = \Hudutech\Controller\DrugInventoryController::getPrice($data['inventoryId'], $data['qty']);
            $cartCreated = \Hudutech\Controller\SalesController::createCart(
                array(
                    "inventoryId" => $data['inventoryId'],
                    "qty" => $data['qty'],
                    "receiptNo" => $data['receiptNo'],
                    "patientId" => isset($data['pId']) ? $data['pId'] : null,
                    "price" => $price
                ));
            if ($cartCreated) {
                print_r(json_encode(
                    array(
                        "statusCode" => 200,
                        "message" => "Drug added to Cart"
                    )));
            } else {
                print_r(json_encode(
                    array(
                        "statusCode" => 500,
                        "message" => "Drug already exists in the Cart"
                    )));
            }
        } else {
            print_r(json_encode(
                array(
                    "statusCode" => 500,
                    "message" => "Quantity cannot be empty"
                )));
        }

    } else {
        print_r(json_encode(
            array(
                "statusCode" => 500,
                "message" => "No Data received"
            )));
    }
} elseif ($requestMethod == 'DELETE') {
    if (!empty($data['id'])){
        $deleted = \Hudutech\Controller\SalesController::removeCartItem($data['id']);
        if ($deleted){
            print_r(json_encode(array(
                "statusCode"=>204,
                "message"=> "Drug Removed From Cart."
            )));
        }
        else{
            print_r(json_encode(array(
                "statusCode"=>500,
                "message"=> "Internal Server Error occurred Drug Not Removed From Cart."
            )));
        }
    }else{
        print_r(json_encode(array(
            "statusCode"=>204,
            "message"=> "Failed To retrieve Cart Info"
        )));
    }
}