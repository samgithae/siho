<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 9:49 AM
 */

namespace Hudutech\AppInterface;

use Hudutech\Entity\Sales;

interface SalesInterface
{
    public function create(Sales $sales);

    public function update(Sales $sales, $id);

    public static function delete($id);

    public static function getId($id);

    public static function getObject($id);

    public static function all();

    public static function generateReceiptNo();

    public static function createCart(array $cart);

    public static function showCartItems($receiptNo);

    public static function updateInventoryQty($inventoryId, $qty);

    public static function checkout(array $cart);

    public static function paidRegFee($patientId);

    public static function canPayConsultationFee($patientId);

    public static function getTotalDrugCost($patientId, $receiptNo);

    public static function getPatientBill($patientId, $receiptNo);

    public static function markPaidRegFee($patientId);

    public static function createReceipt($patientId, $receiptNo);
}