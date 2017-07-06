<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 11:07 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ChargeInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Charge;

class ChargeController implements ChargeInterface
{
    public function create(Charge $charge)
    {
        $db = new DB();
        $conn = $db->connect();
        $chargeName = $charge->getChargeName();
        $cost = $charge->getCost();
        try {
            $stmt = $conn->prepare("INSERT INTO charges(chargeName, cost) 
                                  VALUES (:chargeName, :cost)");
            $stmt->bindParam(":chargeName", $chargeName);
            $stmt->bindParam(":cost", $cost);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(Charge $charge, $id)
    {
        $db = new DB();
        $conn = $db->connect();
        $chargeName = $charge->getChargeName();
        $cost = $charge->getCost();
        try {
            $stmt = $conn->prepare("UPDATE charges SET chargeName=:chargeName, cost=:cost
                                   WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":chargeName", $chargeName);
            $stmt->bindParam(":cost", $cost);
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

        try {
            $stmt = $conn->prepare("DELETE FROM charges WHERE id=:id");
            $stmt->bindParam(":id", $id);
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
            $stmt = $conn->prepare("SELECT t.* FROM charges t WHERE t.id =:id");
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
            $stmt = $conn->prepare("SELECT t.* FROM charges t WHERE t.id =:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Charge::class);
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetch(\PDO::FETCH_ASSOC) : null;
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
            $stmt = $conn->prepare("SELECT t.* FROM charges t WHERE 1");
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getConsultationFee()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT cost FROM charges WHERE chargeName='consultation' LIMIT 1");
            $cost = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $cost = (float)$row['cost'];
            }

            $db->closeConnection();
            return $cost;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

    public static function getRegistrationFee()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT cost FROM charges WHERE chargeName='registration' LIMIT 1");
            $cost = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $cost = (float)$row['cost'];
            }
            $db->closeConnection();
            return $cost;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

}