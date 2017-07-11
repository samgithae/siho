<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/21/17
 * Time: 7:48 PM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\PatientInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Patient;

class PatientController implements PatientInterface
{
    public function create(Patient $patient)
    {
        $db = new DB();
        $conn = $db->connect();
        $currentYear = date('Y');
        $patientNo = $currentYear . "-" . $patient->getPatientNo();
        $surName = $patient->getSurName();
        $idNo = $patient->getIdNo();
        $firstName = $patient->getFirstName();
        $otherName = $patient->getOtherName();
        $maritalStatus = $patient->getMaritalStatus();
        $phoneNumber = $patient->getPhoneNumber();
        $occupation = $patient->getOccupation();
        $patientType = $patient->getPatientType();
        $sex = $patient->getSex();
        $age = $patient->getAge();
        $location = $patient->getLocation();


        try {

            $stmt = $conn->prepare("INSERT INTO patients(
                                                            patientNo,
                                                            idNo,
                                                            surName,
                                                            firstName, 
                                                            otherName,
                                                            maritalStatus,
                                                            phoneNumber,
                                                            occupation,
                                                            patientType,
                                                            sex,
                                                            age,
                                                            location
                                                        )  
                                                VALUES (
                                                            :patientNo,
                                                            :idNo,
                                                            :surName,
                                                            :firstName,
                                                            :otherName,
                                                            :maritalStatus,
                                                            :phoneNumber,
                                                            :occupation,
                                                            :patientType,
                                                            :sex,
                                                            :age,
                                                            :location
                                                            
                                                             
                                                        ) ");
            $stmt->bindParam(":patientNo", $patientNo);
            $stmt->bindParam(":idNo", $idNo);
            $stmt->bindParam(":surName", $surName);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":otherName", $otherName);
            $stmt->bindParam(":maritalStatus", $maritalStatus);
            $stmt->bindParam(":phoneNumber", $phoneNumber);
            $stmt->bindParam(":occupation", $occupation);
            $stmt->bindParam(":patientType", $patientType);
            $stmt->bindParam(":sex", $sex);
            $stmt->bindParam(":age", $age);
            $stmt->bindParam(":location", $location);
            return $stmt->execute() ? true : false;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }

    }

    public function batchCreate(array $patients)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("INSERT INTO patients(
                                                        patientNo,
                                                        surName,
                                                        phoneNumber,
                                                        patientType,
                                                        sex,
                                                        age,
                                                        location
                                                        )  
                                                VALUES (
                                                        :patientNo,
                                                        :surName,
                                                        :phoneNumber,
                                                        :patientType,
                                                        :sex,
                                                        :age,
                                                        :location
                                                        ) ");
            foreach ($patients as $patient) {
                $stmt->bindParam(":patientNo", $patient['patientNo']);
                $stmt->bindParam(":surName", $patient['fullName']);
                $stmt->bindParam(":phoneNumber", $patient['phoneNumber']);
                $stmt->bindParam(":patientType", $patient['patientType']);
                $stmt->bindParam(":sex", $patient['sex']);
                $stmt->bindParam(":age", $patient['age']);
                $stmt->bindParam(":location", $patient['location']);
                $stmt->execute();
            }
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


    public function update(Patient $patient, $id)
    {
        $db = new DB();
        $conn = $db->connect();
        $patientNo = $patient->getPatientNo();
        $sirName = $patient->getSurName();
        $idNo = $patient->getIdNo();
        $firstName = $patient->getFirstName();
        $otherName = $patient->getOtherName();
        $maritalStatus = $patient->getMaritalStatus();
        $phoneNumber = $patient->getPhoneNumber();
        $occupation = $patient->getOccupation();
        $patientType = $patient->getPatientType();
        $sex = $patient->getSex();
        $age = $patient->getAge();
        $location = $patient->getLocation();

        try {

            $stmt = $conn->prepare("UPDATE patients SET
                                                        patientNo=:patientNo,
                                                        idNo=:idNo,
                                                        surName=:surName,
                                                        firstName=:firstName, 
                                                        maritalStatus=:maritalStatus,
                                                        phoneNumber=:phoneNumber,
                                                        occupation=:occupation,
                                                        patientType=:patientType,
                                                        sex=:sex,
                                                        age=:age,
                                                        otherName=:otherName,
                                                        location=:location
                                                     WHERE id=:id
                                                     ");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":patientNo", $patientNo);
            $stmt->bindParam(":idNo", $idNo);
            $stmt->bindParam(":surName", $sirName);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":otherName", $otherName);
            $stmt->bindParam(":maritalStatus", $maritalStatus);
            $stmt->bindParam(":phoneNumber", $phoneNumber);
            $stmt->bindParam(":occupation", $occupation);
            $stmt->bindParam(":patientType", $patientType);
            $stmt->bindParam(":sex", $sex);
            $stmt->bindParam(":age", $age);
            $stmt->bindParam(":location", $location);

            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public static function delete($id)
    {

        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM patients WHERE id=:id");
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

        try {
            $stmt = $conn->prepare("DELETE FROM patients");
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM patients WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getObject($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM patients WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Patient::class);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch() : null;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }


    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM patients WHERE 1");
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function addToQueue($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE patients SET inQueue=1 WHERE id=:id
                                  ");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function showNotInQueue()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM patients WHERE inQueue=0");
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function searchNotInQueue($text){
        $db = new DB();
        $conn = $db->connect();
        try{
           $stmt = $conn->prepare("SELECT * FROM patients WHERE inQueue=0 AND (surName LIKE '%{$text}%'
                                  OR patientNo LIKE '%{$text}%' OR phoneNumber LIKE '%{$text}%' OR 
                                  idNo  LIKE '%{$text}%' OR location LIKE '%{$text}%') LIMIT 25");
           $results = [];
           if($stmt->execute() && $stmt->rowCount()){
               $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
           }
           return $results;
        } catch (\PDOException $e){
            print $e->getMessage();
            return [];
        }
    }

    public static function getPatientId($patientNo)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM patients WHERE patientNo=:patientNo");
            $stmt->bindParam(":patientNo", $patientNo);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function showInQueue()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $sql = "SELECT DISTINCT p.* FROM patients p, patient_visits pv INNER JOIN patients t ON t.id=pv.patientId
                    WHERE `pv`.`status`= 'active' AND
                          DATE_FORMAT(pv.visitDate, '%Y-%m-%d')= CURDATE() AND
                          p.id = pv.patientId";
            $stmt = $conn->prepare($sql);
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


}