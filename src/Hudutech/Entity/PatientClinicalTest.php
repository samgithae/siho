<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 7:39 PM
 */

namespace Hudutech\Entity;


class PatientClinicalTest
{
    /**
     * @var integer
     */
    private $clinicianId;
    /**
     * @var integer
     */
    private $patientId;
    /**
     * @var integer
     */
    private $testId;
    /**
     * @var string
     */
    private $testResult;
    /**
     * @var string
     */
    private $description;
    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var
     */
    private $createdAt;

    /**
     * @var boolean
     */
    private $performed;

    /**
     * @return int
     */
    public function getClinicianId()
    {
        return $this->clinicianId;
    }

    /**
     * @param int $clinicianId
     */
    public function setClinicianId($clinicianId)
    {
        $this->clinicianId = $clinicianId;
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
     * @return int
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * @param int $testId
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;
    }

    /**
     * @return string
     */
    public function getTestResult()
    {
        return $this->testResult;
    }

    /**
     * @param string $testResult
     */
    public function setTestResult($testResult)
    {
        $this->testResult = $testResult;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }



    /**
     * @return bool
     */
    public function isPerformed()
    {
        return $this->performed;
    }

    /**
     * @param bool $performed
     */
    public function setPerformed($performed)
    {
        $this->performed = $performed;
    }


}