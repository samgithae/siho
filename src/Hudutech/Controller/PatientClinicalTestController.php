<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 7:57 PM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\PatientClinicalTestInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\PatientClinicalTest;

class PatientClinicalTestController implements PatientClinicalTestInterface
{
    public function create(PatientClinicalTest $patientClinicalTest)
    {
        $db = new DB();
        $conn = $db->connect();

        $clinicianId = $patientClinicalTest->getClinicianId();
        $patientId = $patientClinicalTest->getPatientId();
        $testId = $patientClinicalTest->getTestId();
        $testResult = $patientClinicalTest->getTestResult();
        $description = $patientClinicalTest->getDescription();
        $isPerformed = $patientClinicalTest->isPerformed();
        $createdAt = $patientClinicalTest->getCreatedAt();

        try {

            $sql = "INSERT INTO patient_clinical_tests(
                                                        clinicianId,
                                                        patientId,
                                                        testId,
                                                        testResult,
                                                        description,
                                                        isPerformed,
                                                        createdAt
                                                        )
                                                  VALUES
                                                   (
                                                        :clinicianId,
                                                        :patientId,
                                                        :testId,
                                                        :testResult,
                                                        :description,
                                                        :isPerformed,
                                                        :createdAt
                                                    )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":clinicianId", $clinicianId);
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":testId", $testId);
            $stmt->bindParam(":testResult", $testResult);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":isPerformed", $isPerformed);
            $stmt->bindParam(":createdAt", $createdAt);
            return $stmt->execute() ? true : false;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(PatientClinicalTest $patientClinicalTest, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $clinicianId = $patientClinicalTest->getClinicianId();
        $description = $patientClinicalTest->getDescription();
        $testResult = $patientClinicalTest->getTestResult();
        $date = $patientClinicalTest->getUpdatedAt();
        $isPerformed = $patientClinicalTest->isPerformed();

        try {
            $sql = "UPDATE patient_clinical_tests SET clinicianId=:clinicianId,
                                                      description=:description,
                                                      testResult=:testResult,
                                                      updatedAt=:updatedAt,
                                                      isPerformed=:isPerformed
                                                      WHERE id=:id
                                                      ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":clinicianId", $clinicianId);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":testResult", $testResult);
            $stmt->bindParam(":updatedAt", $date);
            $stmt->bindParam(":isPerformed", $isPerformed);
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

           $stmt = $conn->prepare("DELETE FROM patient_clinical_tests WHERE id=:id");
           $stmt->bindParam(":id", $id);
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
        try{

            $stmt = $conn->prepare("DELETE FROM patient_clinical_tests");
            return $stmt->execute() ? true : false;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    public static function showClinicalTests($patientId)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $sql = "SELECT c.*, pt.id as patientTestId, pt.testResult, pt.description, pt.isPerformed FROM clinical_tests c
                    INNER JOIN patient_clinical_tests pt ON pt.testId = c.id
                    WHERE pt.patientId=:patientId AND pt.createdAt =CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            $tests = array();
            if($stmt->execute()){
                $tests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $tests;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function showClinicalTestResults($patientId){
        $db = new DB();
        $conn = $db->connect();

        try{
            $sql = "SELECT c.*, pt.id as patientTestId, pt.testResult, pt.description, pt.isPerformed FROM clinical_tests c
                    INNER JOIN patient_clinical_tests pt ON pt.testId = c.id
                    WHERE pt.patientId=:patientId AND pt.createdAt = CURDATE() AND pt.isPerformed=1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            $tests = array();
            if($stmt->execute()){
                $tests = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $tests;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getClinicalTestTotalCost($patientId){
        $db = new DB();
        $conn = $db->connect();
        try{
            $sql = "SELECT SUM(c.cost) as totalCost FROM clinical_tests c
                    INNER JOIN patient_clinical_tests pt ON pt.testId = c.id
                    WHERE pt.patientId=:patientId AND pt.createdAt =CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":patientId", $patientId);
            if($stmt->execute()){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return (float)$row['totalCost'];
            }else{
                return 0;
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

    public static function getObject($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT t.* FROM patient_clinical_tests t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS |\PDO::FETCH_PROPS_LATE, PatientClinicalTest::class);
            return $stmt->execute() && $stmt->rowCount()==1 ? $stmt->fetch() : null;
        } catch (\PDOException $exception) {
            $exception->getMessage();
            return null;
        }
    }


}