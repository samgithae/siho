<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/15/17
 * Time: 11:33 PM
 */

namespace Hudutech\Entity;


class DrugInventory
{
    private $id;
    private $batchNo;
    private $invoiceNo;
    private $productName;
    private $qtyReceived;
    private $supplier;
    private $purchasePrice;
    private $datePurchased;
    private $expiryDate;
    private $doseQty;
    private $dosePrice;
    private $qtyInStock;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBatchNo()
    {
        return $this->batchNo;
    }

    /**
     * @param mixed $batchNo
     */
    public function setBatchNo($batchNo)
    {
        $this->batchNo = $batchNo;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNo()
    {
        return $this->invoiceNo;
    }

    /**
     * @param mixed $invoiceNo
     */
    public function setInvoiceNo($invoiceNo)
    {
        $this->invoiceNo = $invoiceNo;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getQtyReceived()
    {
        return $this->qtyReceived;
    }

    /**
     * @param mixed $qtyReceived
     */
    public function setQtyReceived($qtyReceived)
    {
        $this->qtyReceived = $qtyReceived;
    }

    /**
     * @return mixed
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @param mixed $supplier
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
    }



    /**
     * @return mixed
     */
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    /**
     * @param mixed $purchasePrice
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;
    }

    /**
     * @return mixed
     */
    public function getDatePurchased()
    {
        return $this->datePurchased;
    }

    /**
     * @param mixed $datePurchased
     */
    public function setDatePurchased($datePurchased)
    {
        $this->datePurchased = $datePurchased;
    }

    /**
     * @return mixed
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @param mixed $expiryDate
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return mixed
     */
    public function getDoseQty()
    {
        return $this->doseQty;
    }

    /**
     * @param mixed $doseQty
     */
    public function setDoseQty($doseQty)
    {
        $this->doseQty = $doseQty;
    }

    /**
     * @return mixed
     */
    public function getDosePrice()
    {
        return $this->dosePrice;
    }

    /**
     * @param mixed $dosePrice
     */
    public function setDosePrice($dosePrice)
    {
        $this->dosePrice = $dosePrice;
    }

    /**
     * @return mixed
     */
    public function getQtyInStock()
    {
        return $this->qtyInStock;
    }

    /**
     * @param mixed $qtyInStock
     */
    public function setQtyInStock($qtyInStock)
    {
        $this->qtyInStock = $qtyInStock;
    }

}