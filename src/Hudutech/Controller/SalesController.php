<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 10:00 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\SalesInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Sales;

class SalesController implements SalesInterface
{
    public function create(Sales $sales)
    {
        $db = new DB();
        $conn = $db->connect();
        $patientId = $sales->getPatientId();
        $receiptNo = $sales->getReceiptNo();
        $inventoryId = $sales->getInventoryId();
        $qty = $sales->getQty();
        $price = $sales->getPrice();
        $datePurchased = $sales->getDatePurchased();
        $servedBy = $sales->getServedBy();

        try {

            $stmt = $conn->prepare("INSERT INTO sales(
                                                        patientId,
                                                        inventoryId,
                                                        receiptNo,
                                                        qty,
                                                        price,
                                                        datePurchased,
                                                        servedBy
                                                    )
                                                    VALUES
                                                     (
                                                        :patientId,
                                                        :inventoryId,
                                                        :receiptNo,
                                                        :qty,
                                                        :price,
                                                        :datePurchased,
                                                        :servedBy
                                                    )");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":inventoryId", $inventoryId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":datePurchased", $datePurchased);
            $stmt->bindParam(":servedBy", $servedBy);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function update(Sales $sales, $id)
    {
        $db = new DB();
        $conn = $db->connect();
        $patientId = $sales->getPatientId();
        $inventoryId = $sales->getInventoryId();
        $receiptNo = $sales->getReceiptNo();
        $qty = $sales->getQty();
        $price = $sales->getPrice();
        $datePurchased = $sales->getDatePurchased();
        $servedBy = $sales->getServedBy();

        try {

            $stmt = $conn->prepare("UPDATE sales SET
                                                    patientId=:patientId,
                                                    inventoryId=:inventoryId,
                                                    receiptNo=:receiptNo,
                                                    qty=:qty,
                                                    price=:price,
                                                    datePurchased=:datePurchased,
                                                    servedBy=:servedBy 
                                                     WHERE id=:id
                                                  ");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            $stmt->bindParam(":inventoryId", $inventoryId);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":datePurchased", $datePurchased);
            $stmt->bindParam(":servedBy", $servedBy);
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
            $stmt = $conn->prepare("DELETE FROM sales WHERE id=:id");
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
            $stmt = $conn->prepare("SELECT t.* FROM sales t WHERE t.id=:id");
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
            $stmt = $conn->prepare("SELECT t.* FROM sales t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Sales::class);
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
            $stmt = $conn->prepare("SELECT t.* FROM sales t WHERE 1");
            return $stmt->execute() && $stmt->rowCount() == 1 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function generateReceiptNo()
    {
        $length = 8;
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }


    public static function createCart(array $cart)
    {
        $db = new DB();
        $conn = $db->connect();

        $inventoryId = $cart['inventoryId'];
        $patientId = isset($cart['patientId']) ? $cart['patientId'] : null;
        $receiptNo = $cart['receiptNo'];
        $qty = $cart['qty'];
        $price = $cart['price'];


        try {
            $stmt = $conn->prepare("INSERT INTO cart(
                                                        patientId,
                                                        inventoryId,
                                                        receiptNo,
                                                        qty, 
                                                        price, 
                                                        createdAt
                                                    )
                                                    VALUES (
                                                        :patientId,
                                                        :inventoryId,
                                                        :receiptNo,
                                                        :qty,
                                                        :price,
                                                        CURDATE()
                                                    )");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":inventoryId", $inventoryId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":price", $price);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function showCartItems($receiptNo)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT d.productName, c.* FROM drug_inventory d , cart c
                                    INNER JOIN drug_inventory dr  ON dr.id = c.inventoryId
                                    WHERE c.inventoryId=d.id AND c.receiptNo='{$receiptNo}'");

            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


    public static function removeCartItem($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getCartTotal($receiptNo)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT SUM(price) AS cartTotal FROM cart WHERE receiptNo=:receiptNo");
            $stmt->bindParam(":receiptNo", $receiptNo);
            $cartTotal = 0;
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $cartTotal = (float)$row['cartTotal'];
            }
            return $cartTotal;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function updateInventoryQty($inventoryId, $qty)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("UPDATE drug_inventory SET qtyInStock=qtyInStock-'{$qty}'
                                    WHERE id=:inventoryId");
            $stmt->bindParam(":inventoryId", $inventoryId);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function checkout(array $cart)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO sales(
                                                        patientId,
                                                        inventoryId,
                                                        qty, 
                                                        price,
                                                        datePurchased,
                                                        receiptNo
                                                    ) VALUES (
                                                        :patientId,
                                                        :inventoryId,
                                                        :qty, 
                                                        :price,
                                                        :datePurchased,
                                                        :receiptNo
                                                    )");

            foreach ($cart as $cartItem) {
                $stmt->bindParam(":patientId", $cartItem['patientId']);
                $stmt->bindParam(":inventoryId", $cartItem['inventoryId']);
                $stmt->bindParam(":qty", $cartItem['qty']);
                $stmt->bindParam(":price", $cartItem['price']);
                $stmt->bindParam(":datePurchased", $cartItem['createdAt']);
                $stmt->bindParam(":receiptNo", $cartItem['receiptNo']);
                if ($stmt->execute()) {
                    self::updateInventoryQty($cartItem['inventoryId'], $cartItem['qty']);
                }
            }

            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function paidRegFee($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        // check if the patient is registered
        try {
            $stmt = $conn->prepare("SELECT t.* FROM patients t WHERE t.id=:patientId");
            $stmt->bindParam(":patientId", $patientId);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                // the user is registered so we check if he/she paid the reg fee
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $paid = $row['regFeePaid'];
                if ($paid == 1) {
                    return true;
                } elseif ($paid == 0) {
                    return false;
                } else {
                    return true;
                }

            } else {
                return true;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 01;
        }
    }

    public static function canPayConsultationFee($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {

            $stmt = $conn->prepare("SELECT t.id FROM clinical_notes t WHERE
                                  t.patientId=:patientId AND date(t.date)=CURDATE()");
            $stmt->bindParam(":patientId", $patientId);
            if ($stmt->execute() and $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 01;
        }
    }

    public static function getTotalDrugCost($patientId, $receiptNo)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(t.price) AS totalPrice FROM sales t
                                    WHERE t.patientId=:patientId AND t.receiptNo=:receiptNo AND
                                     date(t.datePurchased)=CURDATE()");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return (float)$row['totalPrice'];
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function testCost($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(ct.cost) AS testCost FROM clinical_tests ct , patient_clinical_tests ppt
                                    INNER JOIN clinical_tests ctl ON ctl.id = ppt.testId WHERE ppt.testId=ct.id
                                    AND ppt.isPerformed=1 AND date(ppt.updatedAt) =CURDATE() AND patientId=:patientId");

            $stmt->bindParam(":patientId", $patientId);
            $testCost = 0;
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $testCost = (float)$row['testCost'];
            }
            return $testCost;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

    public static function getPatientBill($patientId, $receiptNo)
    {
        $bill = array();
        $paidRegFee = self::paidRegFee($patientId);
        $canPayConsultationFee = self::canPayConsultationFee($patientId);
        if (!$paidRegFee) {
            $bill['regFee'] = ChargeController::getRegistrationFee();
        }
        if ($canPayConsultationFee) {
            $bill['consultationFee'] = ChargeController::getConsultationFee();
        }
        $bill['drugCost'] = self::getTotalDrugCost($patientId, $receiptNo);
        $totalCharges = 0;
        if (isset($bill['regFee']) && isset($bill['consultationFee'])) {
            $totalCharges = (float)$bill['regFee'] + (float)$bill['consultationFee'];
        }
        if (isset($bill['regFee']) && !isset($bill['consultationFee'])) {
            $totalCharges = (float)$bill['regFee'];
        }
        if (isset($bill['consultationFee']) && !isset($bill['regFee'])) {
            $totalCharges = (float)$bill['consultationFee'];
        }

        $testCost = self::testCost($patientId);

        $totalCost = $totalCharges + (float)$bill['drugCost'] + $testCost;
        $bill['testCost'] = $testCost;
        $bill['totalCost'] = $totalCost;
        return $bill;
    }

    public static function markPaidRegFee($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE patients SET regFeePaid=1 WHERE id=:patientId");
            $stmt->bindParam(":patientId", $patientId);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function createReceipt($patientId, $receiptNo)
    {
        $db = new DB();
        $conn = $db->connect();

        $bill = self::getPatientBill($patientId, $receiptNo);
        $regFee = isset($bill['regFee']) ? $bill['regFee'] : null;
        $consultFee = isset($bill['consultationFee']) ? $bill['consultationFee'] : null;
        $totalCost = $bill['totalCost'];

        try {
            $stmt = $conn->prepare("INSERT INTO sales_receipts(
                                                                patientId, 
                                                                receiptNo,
                                                                consultationFee,
                                                                regFee,
                                                                totalCost
                                                              ) 
                                                            VALUES
                                                             (
                                                                :patientId,
                                                                :receiptNo,
                                                                :consultationFee,
                                                                :regFee,
                                                                :totalCost
                                                            )");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            $stmt->bindParam(":consultationFee", $consultFee);
            $stmt->bindParam(":regFee", $regFee);
            $stmt->bindParam(":totalCost", $totalCost);
            if ($stmt->execute()) {
                if (!is_null($regFee)) {
                    self::markPaidRegFee($patientId);
                }
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


    // receipt details info
    public static function getTestDetails($patientId)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT ct.testName, ct.cost FROM clinical_tests ct , patient_clinical_tests ppt
                                    INNER JOIN clinical_tests ctl ON ctl.id = ppt.testId WHERE ppt.testId=ct.id
                                    AND ppt.isPerformed=1 AND date(ppt.updatedAt) =CURDATE() AND patientId=:patientId");

            $stmt->bindParam(":patientId", $patientId);
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $details = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $details[] = array(
                        "testName" => $row['testName'],
                        "cost" => $row['cost']
                    );
                }
                return $details;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getDrugDetails($patientId, $receiptNo)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT DISTINCT t.productName, s.qty, s.price FROM drug_inventory t, sales s
                                    INNER JOIN drug_inventory dl ON dl.id=s.inventoryId WHERE dl.id=s.inventoryId
                                    AND s.patientId=:patientId AND DATE(dl.datePurchased)=CURDATE() AND
                                    s.receiptNo=:receiptNo;");
            $stmt->bindParam(":patientId", $patientId);
            $stmt->bindParam(":receiptNo", $receiptNo);
            $details = array();
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $details[] = array(
                        "productName" => $row['productName'],
                        "qty" => $row['qty'],
                        "price" => $row['price']
                    );
                }
            }
            return $details;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }


    /**
     * @param $patientId
     * @param $receiptNo
     * @return array
     *
     */
    public static function getCheckoutDetails($patientId, $receiptNo)
    {
        $regFee = self::getPatientBill($patientId, $receiptNo);
        $checkoutDetails = array(
            "drugs" => self::getDrugDetails($patientId, $receiptNo),
            "tests" => self::getTestDetails($patientId),
            "regFee" => isset($regFee['regFee']) ? $regFee['regFee'] : 0,
            "consultationFee" => self::getPatientBill($patientId, $receiptNo)['consultationFee'],
            "totalCost" => self::getPatientBill($patientId, $receiptNo)['totalCost']
        );
        return $checkoutDetails;
    }


    public static function showSales()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT DISTINCT t.productName, s.receiptNo, s.price , s.qty ,s.datePurchased
                                    FROM drug_inventory t, sales s
                                    INNER JOIN drug_inventory dr ON s.inventoryId = dr.id
                                    WHERE s.inventoryId = dr.id ORDER BY s.receiptNo ");
            return $stmt->execute() && $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function todayLabTestEarning()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(ct.cost) AS testCost FROM clinical_tests ct , patient_clinical_tests ppt
                                    INNER JOIN clinical_tests ctl ON ctl.id = ppt.testId WHERE ppt.testId=ct.id
                                    AND ppt.isPerformed=1 AND date(ppt.updatedAt)=CURDATE()");
            $testCost = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $testCost = (float)$row['testCost'];
            }
            return $testCost;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

    public static function todayDrugSales()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(t.price) AS totalPrice FROM sales t
                                    WHERE date(t.datePurchased)=CURDATE()");
            $total = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $total = (float)$row['totalPrice'];
            }
            return $total;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return 0;
        }
    }

    public static function todayRegFee()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(t.regFee) AS total FROM sales_receipts t WHERE date(t.datePaid)=CURDATE()");
            $total = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $total = (float)$row['total'];
            }
            return $total;
        } catch (\PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public static function todayConsultationFee()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT SUM(t.consultationFee) AS total FROM sales_receipts t WHERE date(t.datePaid)=CURDATE()");
            $total = 0;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $total = (float)$row['total'];
            }
            return $total;
        } catch (\PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public static function todaySales()
    {
        $drugs = self::todayDrugSales();
        $reg = self::todayRegFee();
        $consul = self::todayConsultationFee();
        $test = self::todayLabTestEarning();
        $aggr = (float)($drugs + $reg + $consul + $test);
        return [
            "drugSales" => $drugs,
            "regFeeTotal" => $reg,
            "consultationTotal" => $consul,
            "labTestTotal" => $test,
            "totalSales" => $aggr
        ];
    }

}