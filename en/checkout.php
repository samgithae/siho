<?php
session_start();
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/18/17
 * Time: 3:34 PM
 */

require_once __DIR__.'/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['cost'])){
    $cartTotal = \Hudutech\Controller\SalesController::getCartTotal($_SESSION['receiptNo']);
    if ($cartTotal == (float)$data['cost']) {
        $procedureFee=$data['procedureFee'];
        $cart = \Hudutech\Controller\SalesController::showCartItems($_SESSION['receiptNo']);
        $checked = \Hudutech\Controller\SalesController::checkout($cart);
        $receipt = \Hudutech\Controller\SalesController::createReceipt($cart[0]['patientId'], $cart[0]['receiptNo'],$procedureFee);
        if ($receipt){
            $marked = \Hudutech\Controller\DrugPrescriptionController::markSold($cart[0]['patientId']);
            if ($marked){
                unset($_SESSION['receiptNo']);
                unset($_SESSION['pId']);
                unset($_SESSION['pNo']);
                
                print_r(json_encode(array(
                    "statusCode"=>200,
                    "message"=>"Checkout Completed successfully."
                )));
            }

        }else{
            print_r(json_encode(array(
                "statusCode"=>500,
                "message"=>"Internal Error occurred While creating checkout receipt."
            )));
        }
    }
}