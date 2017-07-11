<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/21/17
 * Time: 7:50 PM
 */

namespace Hudutech\Entity;


class Patient
{
    /**
     * @var string
     */
    private $patientNo;
    /**
     * @var integer
     */
    private $idNo;
    /**
     * @var string
     */
    private $surName;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $otherName;
    /**
     * @var string
     */
    private $sex;
    /**
     * @var string
     */
    private $maritalStatus;

    /**
     * @var string
     */
    private $occupation;

    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var string
     */
    private $patientType;
    /**
     * @var string
     */
    private $age;

    /**
     * @var string
     */
    private $location;

    /**
     * @var boolean
     */
    private $inQueue;
    /**
     * @return string
     */

    public function getPatientNo()
    {
        return $this->patientNo;
    }

    /**
     * @param string $patientNo
     */
    public function setPatientNo($patientNo)
    {
        $this->patientNo = $patientNo;
    }

    /**
     * @return int
     */
    public function getIdNo()
    {
        return $this->idNo;
    }

    /**
     * @param int $idNo
     */
    public function setIdNo($idNo)
    {
        $this->idNo = $idNo;
    }

    /**
     * @return string
     */
    public function getSurName()
    {
        return $this->surName;
    }

    /**
     * @param string $surName
     */
    public function setSurName($surName)
    {
        $this->surName = $surName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getOtherName()
    {
        return $this->otherName;
    }

    /**
     * @param string $otherName
     */
    public function setOtherName($otherName)
    {
        $this->otherName = $otherName;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }



    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPatientType()
    {
        return $this->patientType;
    }

    /**
     * @param string $patientType
     */
    public function setPatientType($patientType)
    {
        $this->patientType = $patientType;
    }

    /**
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param string $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function isInQueue()
    {
        return $this->inQueue;
    }

    /**
     * @param bool $inQueue
     */
    public function setInQueue($inQueue)
    {
        $this->inQueue = $inQueue;
    }

}