<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/11/17
 * Time: 2:41 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';
use \Hudutech\Controller\DrugInventoryController;

$data = json_decode(file_get_contents('php://input'), true);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'PUT' && !empty($data)) {
    updateDrugInventory();
}
if ($requestMethod == 'DELETE') {
    deleteDrugInventory();
}

function updateDrugInventory()
{
    global $data;
    $object = DrugInventoryController::getObject($data['id']);
    $object->setBatchNo($data['batchNo']);
    $object->setInvoiceNo($data['invoiceNo']);
    $object->setDatePurchased($data['datePurchased']);
    $object->setExpiryDate($data['expiryDate']);
    $object->setProductName($data['productName']);
    $object->setQtyReceived($data['qtyReceived']);
    $object->setDoseQty($data['doseQty']);
    $object->setDosePrice($data['dosePrice']);
    $object->setQtyInStock($data['qtyInStock']);
    $object->setSupplier($data['supplier']);

    $inventoryCtrl = new \Hudutech\Controller\DrugInventoryController();
    $updated = $inventoryCtrl->update($object, $data['id']);
    if ($updated) {
        print_r(json_encode(array(
            "statusCode" => 201,
            "message" => "Inventory Updated Successfully"
        )));
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "Error occurred While Updating.."
        )));
    }


}

function deleteDrugInventory()
{
    global $data;
    $deleted = \Hudutech\Controller\DrugInventoryController::delete($data['id']);
    if ($deleted) {
        print_r(json_encode(array(
            "statusCode" => 204,
            "message" => "Inventory Deleted!."
        )));
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "Error occurred While Deleting.."
        )));
    }
}