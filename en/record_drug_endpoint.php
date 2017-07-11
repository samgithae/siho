<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/9/17
 * Time: 7:13 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'),true);
$requestMethod=$_SERVER['REQUEST_METHOD'];
if($requestMethod=='POST') {

    if (!empty($data)) {

        if (!empty($data['productName']) && !empty($data['qtyReceived'])) {
            $drugs = new \Hudutech\Entity\DrugInventory();
            $drugs->setBatchNo($data['batchNo']);
            $drugs->setInvoiceNo($data['invoiceNo']);
            $drugs->setProductName($data['productName']);
            $drugs->setQtyReceived($data['qtyReceived']);
            $drugs->setSupplier($data['supplier']);
            $drugs->setPurchasePrice($data['purchasePrice']);
            $drugs->setDatePurchased($data['datePurchased']);
            $drugs->setExpiryDate($data['expiryDate']);
            $drugs->setDoseQty($data['doseQty']);
            $drugs->setDosePrice($data['dosePrice']);
            $drugs->setQtyInStock($data['qtyInStock']);



            $drugCtrl = new \Hudutech\Controller\DrugInventoryController();

            $created = $drugCtrl->create($drugs);

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
                    "message" => "Product name cannot be blank."
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
