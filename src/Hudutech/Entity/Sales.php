<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/15/17
 * Time: 11:47 PM
 */

namespace Hudutech\Entity;


class Sales
{
    private $id;
    private $patientId;
    private $receiptNo;
    private $inventoryId;
    private $qty;
    private $price;
    private $datePurchased;
    private $servedBy;

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
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * @param mixed $patientId
     */
    public function setPatientId($patientId)
    {
        $this->patientId = $patientId;
    }

    /**
     * @return mixed
     */
    public function getReceiptNo()
    {
        return $this->receiptNo;
    }

    /**
     * @param mixed $receiptNo
     */
    public function setReceiptNo($receiptNo)
    {
        $this->receiptNo = $receiptNo;
    }



    /**
     * @return mixed
     */
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * @param mixed $inventoryId
     */
    public function setInventoryId($inventoryId)
    {
        $this->inventoryId = $inventoryId;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
    public function getServedBy()
    {
        return $this->servedBy;
    }

    /**
     * @param mixed $servedBy
     */
    public function setServedBy($servedBy)
    {
        $this->servedBy = $servedBy;
    }

}