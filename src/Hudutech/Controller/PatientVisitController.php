<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/8/17
 * Time: 11:53 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\PatientVisitInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\PatientVisit;

class PatientVisitController implements PatientVisitInterface
{
    public function create(PatientVisit $patientVisit)
    {
        $db = new DB();
        $conn = $db->connect();
        $patientId = $patientVisit->getPatientId();
        $status = $patientVisit->getStatus();

        try {
            $stmt = $conn->prepare("INSERT INTO patient_visits(patientId, status)
                                    VALUES (:patientId, :status)");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":status", $status);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(PatientVisit $patientVisit, $id)
    {
        // TODO: Implement update() method.
    }

    public static function delete($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM patient_visits WHERE patientId=:patientId");
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM patient_visits");
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }
    }

    public static function getId($patientId)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $sql = "SELECT p.*, pv.visitDate FROM patients p, patient_visits pv
                    INNER JOIN patients pt ON pt.id=pv.patientId
                    WHERE pv.patientId=:patientId AND
                     `status`='active' AND 
                     date(pv.visitDate) =CURDATE()
                    ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();


        try {
            $sql = "SELECT p.*, pv.visitDate FROM patients p, patient_visits pv
                    INNER JOIN patients pt ON pt.id=pv.patientId
                    WHERE `status`='active' AND 
                     date(pv.visitDate) =CURDATE()
                    ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function markAsLeft($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {

            $stmt = $conn->prepare("UPDATE patient_visits SET `status`='left' WHERE patientId=:patientId AND date(visitDate)=CURDATE()
                                    ;UPDATE patients SET inQueue=0 WHERE id=:patientId");
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

}