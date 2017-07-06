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
            $products = new \Hudutech\Entity\ProductInventory();
            $products->setBatchNo($data['batchNo']);
            $products->setInvoiceNo($data['invoiceNo']);
            $products->setProductName($data['productName']);
            $products->setQtyReceived($data['qtyReceived']);
            $products->setSupplier($data['supplier']);
            $products->setPurchasePrice($data['purchasePrice']);
            $products->setSalePrice($data['salePrice']);
            $products->setPurchaseDate($data['purchaseDate']);
            $products->setExpiryDate($data['expiryDate']);

            $productCtrl = new \Hudutech\Controller\ProductInventoryController();

            $created = $productCtrl->create($products);

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
