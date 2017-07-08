<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/8/17
 * Time: 3:35 PM
 */

namespace Hudutech\Entity;


/**
 * Class DrugPrescription
 * @package Hudutech\Entity
 */
class DrugPrescription
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $patientId;
    /**
     * @var integer
     */
    private $duration;

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
    /**
     * @var string
     */
    private $drugName;
    /**
     * @var string
     */
    private $drugType;
    /**
     * @var float
     */
    private $quantity;

    /**
     * @var string
     */
    private $prescription;
    /**
     * @var string
     */
    private $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * @param int $patientId
     */
    public function setPatientId($patientId)
    {
        $this->patientId = $patientId;
    }

    /**
     * @return string
     */
    public function getDrugName()
    {
        return $this->drugName;
    }

    /**
     * @param string $drugName
     */
    public function setDrugName($drugName)
    {
        $this->drugName = $drugName;
    }

    /**
     * @return string
     */
    public function getDrugType()
    {
        return $this->drugType;
    }

    /**
     * @param string $drugType
     */
    public function setDrugType($drugType)
    {
        $this->drugType = $drugType;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getPrescription()
    {
        return $this->prescription;
    }

    /**
     * @param string $prescription
     */
    public function setPrescription($prescription)
    {
        $this->prescription = $prescription;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}