<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/21/17
 * Time: 11:52 PM
 */

namespace Hudutech\Entity;


class ClinicalNote
{

    /**
     * @var string
     */
    private $patientId;

    /**
     * @var string
     */
    private $complaint;
    /**
     * @var string
     */
    private $complaintHistory;
    /**
     * @var string
     */
    private $familySocialHistory;
    /**
     * @var string
     */
    private $physicalExamination;
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @return string
     */
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * @param string $patientId
     */
    public function setPatientId($patientId)
    {
        $this->patientId = $patientId;
    }


    /**
     * @return string
     */
    public function getComplaint()
    {
        return $this->complaint;
    }

    /**
     * @param string $complaint
     */
    public function setComplaint($complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * @return string
     */
    public function getComplaintHistory()
    {
        return $this->complaintHistory;
    }

    /**
     * @param string $complaintHistory
     */
    public function setComplaintHistory($complaintHistory)
    {
        $this->complaintHistory = $complaintHistory;
    }

    /**
     * @return string
     */
    public function getFamilySocialHistory()
    {
        return $this->familySocialHistory;
    }

    /**
     * @param string $familySocialHistory
     */
    public function setFamilySocialHistory($familySocialHistory)
    {
        $this->familySocialHistory = $familySocialHistory;
    }

    /**
     * @return string
     */
    public function getPhysicalExamination()
    {
        return $this->physicalExamination;
    }

    /**
     * @param string $physicalExamination
     */
    public function setPhysicalExamination($physicalExamination)
    {
        $this->physicalExamination = $physicalExamination;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}