<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 2:27 PM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ClinicalTestInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\ClinicalTest;

class ClinicalTestController implements ClinicalTestInterface
{
    public function create(ClinicalTest $clinicalTest)
    {
        $db = new DB();
        $conn= $db->connect();
        $testName = $clinicalTest->getTestName();
        $cost = $clinicalTest->getCost();

        try{
            $sql = "INSERT INTO clinical_tests (testName, cost) VALUES (:testName, :cost)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":testName", $testName);
            $stmt->bindParam(":cost", $cost);
            return $stmt->execute() ? true : false;

        }catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }


    }

    public function update(ClinicalTest $clinicalTest, $id)
    {
        $db = new DB();
        $conn= $db->connect();
        $testName = $clinicalTest->getTestName();
        $cost = $clinicalTest->getCost();

        try{
            $sql = "UPDATE clinical_tests SET testName=:testName, cost=:cost WHERE id=:id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":testName", $testName);
            $stmt->bindParam(":cost", $cost);
            return $stmt->execute() ? true : false;

        }catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("DELETE FROM clinical_tests WHERE id=:id");
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
            $stmt = $conn->prepare("DELETE FROM clinical_tests ");
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

        try{

            $stmt = $conn->prepare("SELECT * FROM clinical_tests WHERE id=:id");
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

        try{

            $stmt = $conn->prepare("SELECT * FROM clinical_tests WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ClinicalTest::class);
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

        try{

            $stmt = $conn->prepare("SELECT * FROM clinical_tests WHERE 1");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() && $stmt->rowCount()>0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [] ;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

}