<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 12:17 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ClinicalNoteInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\ClinicalNote;

class ClinicalNoteController implements ClinicalNoteInterface
{
    /**
     * @param ClinicalNote $clinicalNote
     * @return bool
     */
    public function create(ClinicalNote $clinicalNote)
    {
        $db = new DB();
        $conn = $db->connect();

        $patientId = $clinicalNote->getPatientId();
        $complaint = $clinicalNote->getComplaint();
        $complaintHistory = $clinicalNote->getComplaintHistory();
        $familySocialHistory = $clinicalNote->getFamilySocialHistory();
        $physicalExamination = $clinicalNote->getPhysicalExamination();
        $diagnosis=$clinicalNote->getDiagnosis();
        $date = $clinicalNote->getDate();

        try{

            $sql = "INSERT INTO clinical_notes(
                                                patientId,
                                                complaint,
                                                complaintHistory,
                                                familySocialHistory,
                                                physicalExamination,
                                                diagnosis,
                                                date
                                              )
                                     VALUES
                                            (
                                                :patientId,
                                                :complaint,
                                                :complaintHistory,
                                                :familySocialHistory,
                                                :physicalExamination,
                                                :diagnosis,
                                                :date
                                            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":complaint", $complaint);
            $stmt->bindParam(":complaintHistory", $complaintHistory);
            $stmt->bindParam(":familySocialHistory", $familySocialHistory);
            $stmt->bindParam(":physicalExamination", $physicalExamination);
            $stmt->bindParam(":diagnosis", $diagnosis);
            $stmt->bindParam(":date", $date);

            return $stmt->execute() ? true : false;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }

    }

    /**
     * @param ClinicalNote $clinicalNote
     * @param $id
     * @return bool
     */
    public function update(ClinicalNote $clinicalNote, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $patientId = $clinicalNote->getPatientId();
        $complaint = $clinicalNote->getComplaint();
        $complaintHistory = $clinicalNote->getComplaintHistory();
        $familySocialHistory = $clinicalNote->getFamilySocialHistory();
        $physicalExamination = $clinicalNote->getPhysicalExamination();
        $diagnosis=$clinicalNote->getDiagnosis();

        try {
            $sql = "UPDATE clinical_notes SET
                                         patientId=:patientId,
                                         complaint=:complaint,
                                         complaintHistory=:complaintHistory,
                                         familySocialHistory=:familySocialHistory,
                                         physicalExamination=:physicalExamination,
                                         diagnosis=:diagnosis
                                         ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":complaint", $complaint);
            $stmt->bindParam(":complaintHistory", $complaintHistory);
            $stmt->bindParam(":familySocialHistory", $familySocialHistory);
            $stmt->bindParam(":physicalExamination", $physicalExamination);
            $stmt->bindParam(":diagnosis", $diagnosis);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM clinical_notes WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        }  catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM clinical_notes");
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $patientId
     * @return array
     */
    public static function getAllClinicalNoteByPatientId($patientId)
    {
       $db = new DB();
       $conn = $db->connect();

       try{
           $stmt = $conn->prepare("SELECT * FROM clinical_notes WHERE patientId=:patientId");
           $stmt->bindParam(":patientId", $patientId);
           $stmt->execute();
           $notes = array();
           if ($stmt->rowCount() > 0) {
               while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                   $note = array(
                      "id"=>$row['id'],
                       "patientId" =>$row['patientId'],
                       "complaint" => $row['complaint'],
                       "complaintHistory"=>$row['complaintHistory'],
                       "familySocialHistory"=>$row['familySocialHistory'],
                       "physicalExamination"=>$row['physicalExamination'],
                       "diagnosis"=>$row['diagnosis'],
                       "date"=>$row['date']
                   );
                   $notes[] = $note;
               }
           }
           return $notes;

       } catch (\PDOException $exception) {
           echo $exception->getMessage();
           return [];
       }
    }

    /**
     * @param $patientId
     * @param $date
     * @return array
     */
    public static function getClinicalNoteByDate($patientId, $date)
    {

        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM clinical_notes WHERE patientId=:patientId AND date=:date");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":date", $date);
            $stmt->execute();
            $notes = array();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $notes = array(
                        "id"=>$row['id'],
                        "patientId" =>$row['patientId'],
                        "complaint" => $row['complaint'],
                        "complaintHistory"=>$row['complaintHistory'],
                        "familySocialHistory"=>$row['familySocialHistory'],
                        "physicalExamination"=>$row['physicalExamination'],
                        "date"=>$row['date']
                    );

                }
            }
            return $notes;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $patientId
     * @param $date
     * @return ClinicalNote|null
     * use this method to get the instance of the ClinicalNote entity that
     * has the current values set for the database. set new attributes
     * which you want to update.
     * this makes work easier when updating.
     */
    public static function getObject($patientId, $date)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM clinical_notes WHERE patientId=:patientId AND date=:date");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":date", $date);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ClinicalNote::class);
            return $stmt->execute() && $stmt->rowCount() == 0 ? $stmt->fetch() : null;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function getPatientFromClinicalNotes($patientId){
        $db = new DB();
        $conn = $db->connect();

        try{

            $sql = "SELECT DISTINCT pt.* FROM patients pt, clinical_notes c 
                    INNER JOIN patients p ON p.id = c.patientId
                    WHERE c.patientId =:patientId AND
                     c.patientId = pt.id AND date(c.date)=CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        }catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


}