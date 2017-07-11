<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 8:37 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ProductInventoryInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\ProductInventory;

class ProductInventoryController implements ProductInventoryInterface
{
    public function create(ProductInventory $productInventory)
    {
        $db = new DB();
        $conn = $db->connect();

        $batchNo = $productInventory->getBatchNo();
        $invoiceNo = $productInventory->getInvoiceNo();
        $productName = $productInventory->getProductName();
        $qtyReceived = $productInventory->getQtyReceived();
        $supplier = $productInventory->getSupplier();
        $purchasePrice = $productInventory->getPurchasePrice();
        $salePrice = $productInventory->getSalePrice();
        $purchaseDate = $productInventory->getPurchaseDate();
        $expiryDate = $productInventory->getExpiryDate();

        try{
            $stmt = $conn->prepare("INSERT INTO product_inventory(
                                                                    batchNo,
                                                                    invoiceNo, 
                                                                    productName,
                                                                    qtyReceived,
                                                                    supplier,
                                                                    purchasePrice, 
                                                                    salePrice, 
                                                                    purchaseDate, 
                                                                    expiryDate
                                                                )
                                                                VALUES (
                                                                    :batchNo,
                                                                    :invoiceNo, 
                                                                    :productName,
                                                                    :qtyReceived,
                                                                    :supplier,
                                                                    :purchasePrice,
                                                                    :salePrice, 
                                                                    :purchaseDate, 
                                                                    :expiryDate
                                                                )");
            $stmt->bindParam(":batchNo",$batchNo);
            $stmt->bindParam(":invoiceNo", $invoiceNo);
            $stmt->bindParam(":productName", $productName);
            $stmt->bindParam(":qtyReceived", $qtyReceived);
            $stmt->bindParam(":supplier", $supplier);
            $stmt->bindParam(":purchasePrice", $purchasePrice);
            $stmt->bindParam(":salePrice", $salePrice);
            $stmt->bindParam(":purchaseDate", $purchaseDate);
            $stmt->bindParam(":expiryDate", $expiryDate);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            print_r(json_encode(array("err"=>$exception->getMessage())));
            return false;
        }


    }

    public function update(ProductInventory $productInventory, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $batchNo = $productInventory->getBatchNo();
        $invoiceNo = $productInventory->getInvoiceNo();
        $productName = $productInventory->getProductName();
        $qtyReceived = $productInventory->getQtyReceived();
        $purchasePrice = $productInventory->getPurchasePrice();
        $salePrice = $productInventory->getSalePrice();
        $purchaseDate = $productInventory->getPurchaseDate();
        $expiryDate = $productInventory->getExpiryDate();

        try{
            $stmt = $conn->prepare("UPDATE product_inventory SET
                                                                   batchNo=:batchNo,
                                                                    invoiceNo=:invoiceNo, 
                                                                    productName=:productName,
                                                                    qtyReceived=:qtyReceived,
                                                                    purchasePrice=:purchasePrice, 
                                                                    salePrice=:salePrice, 
                                                                    purchaseDate=:purchaseDate, 
                                                                    expiryDate=:expiryDate
                                                                WHERE id=:id
                                                                
                                                               ");
            $stmt->bindParam(":id",$id);
            $stmt->bindParam(":batchNo",$batchNo);
            $stmt->bindParam(":invoiceNo", $invoiceNo);
            $stmt->bindParam(":productName", $productName);
            $stmt->bindParam(":qtyReceived", $qtyReceived);
            $stmt->bindParam(":purchasePrice", $purchasePrice);
            $stmt->bindParam(":salePrice", $salePrice);
            $stmt->bindParam(":purchaseDate", $purchaseDate);
            $stmt->bindParam(":expiryDate", $expiryDate);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM product_inventory WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true :false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT t.* FROM product_inventory t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() && $stmt->rowCount() ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getObject($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT t.* FROM product_inventory t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS |\PDO::FETCH_PROPS_LATE, ProductInventory::class);
            return $stmt->execute() && $stmt->rowCount() ? $stmt->fetch() : null;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT t.* FROM product_inventory t WHERE 1");
            return $stmt->execute() && $stmt->rowCount() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


}