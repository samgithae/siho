<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/21/17
 * Time: 11:15 PM
 */
session_start();
require_once __DIR__.'/vendor/autoload.php';

//echo date('Y-m-d');
//$loggedInAs = \Hudutech\Controller\UserController::getLoggedInUser('admin');
//echo $loggedInAs;
//$ctrl = new \Hudutech\Controller\PatientController();
//$patient  = new \Hudutech\Entity\Patient();
//
//$patient->setPatientId(rand(0, 1000));
//$patient->setIdNo(373833);
//$patient->setSirName("NJIIRI");
//$patient->setFirstName("JOHN");
//$patient->setOtherName("KIMEMIA");
//$patient->setMaritalStatus("single");
//$patient->setPhoneNumber("0783383939");
//$patient->setOccupation("FARMER");
//$patient->setPatientType("out_patient");
//$patient->setSex("M");

 //$ctrl->create($patient);

//print_r(\Hudutech\Controller\PatientController::all());

//$ctrl = \Hudutech\Controller\PatientClinicalTestController::destroy();
//
//print_r($ctrl);

//$ctrl = \Hudutech\Controller\PatientVisitController::all();
//print_r($ctrl);

//echo \Hudutech\Controller\PatientController::getPatientId(48494)['id'];

//$today = date('Y-m-d');
//$patientTests = \Hudutech\Controller\PatientClinicalTestController::showClinicalTests(5, $today);
//print_r($patientTests);

//$patientId = \Hudutech\Controller\PatientController::getPatientId('4844')['id'];
//print_r($patientId);

//$queuePatients= \Hudutech\Controller\PatientController::showInQueue();
//print_r(json_encode($queuePatients));


//$product = new \Hudutech\Entity\ProductInventory();
//$product->setBatchNo(1234);
//$product->setInvoiceNo(345667);
//$product->setProductName("Sugar");
//$product->setQtyReceived(42);
//$product->setPurchaseDate(date('Y-m-d'));
//$product->setSupplier('hudutech');
//$product->setSalePrice(56);
//$product->setPurchasePrice(30);
//$product->setExpiryDate(date('Y-m-d'));
//
//$inventoryCtrl = new \Hudutech\Controller\ProductInventoryController();
//$created = $inventoryCtrl->create($product);
//if ($created) {
//    echo "worked";
//} else{
//    echo "didnt work";
//}

//$queuePatients= \Hudutech\Controller\PatientController::showInQueue();
//print_r($queuePatients);
//echo date('Y-m-d');

//$prescriptions = \Hudutech\Controller\DrugPrescriptionController::getPrescriptions(2836);
//print_r($prescriptions);

//$cart = \Hudutech\Controller\SalesController::showCartItems($_SESSION['receiptNo']);
//
//print_r($cart);
//$checked = \Hudutech\Controller\SalesController::checkout($cart);

//$receipt = \Hudutech\Controller\SalesController::createReceipt($cart[0]['patientId'], $cart[0]['receiptNo']);

$user = \Hudutech\Controller\UserController::getLoggedInUser('njeru');
print_r($user);