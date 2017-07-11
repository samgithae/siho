<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 04/05/2017
 * Time: 08:55
 */
$success_msg = "";
$error_msg = "";

if(isset($_POST['patientNo'])) {
    if (!empty($_POST['patientNo']) and !empty($_POST['fullName']) and !empty($_POST['sex']) and !empty($_POST['age'])) {

        $patient = new \Hudutech\Entity\Patient();
        $patient->setPatientNo($_POST['patientNo']);
        $patient->setIdNo(null);
        $patient->setSurName($_POST['fullName']);
        $patient->setFirstName(null);
        $patient->setOtherName(null);
        $patient->setMaritalStatus(null);
        $patient->setPhoneNumber($_POST['phoneNumber']);
        $patient->setOccupation(null);
        $patient->setPatientType($_POST['patientType']);
        $patient->setSex($_POST['sex']);
        $patient->setAge($_POST['age']);
        $patient->setLocation($_POST['location']);


        $patientController = new \Hudutech\Controller\PatientController();

        if ($patientController->create($patient)) {
            $success_msg .= "Patient  Registered successfully";
        } else {
            $error_msg .= 'Error registering Patient, please try again ';
        }
    } else {

        $error_msg .= 'All fields required';
    }
}