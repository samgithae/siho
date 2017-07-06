<?php
session_start();
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/22/17
 * Time: 7:22 AM
 */

require_once __DIR__.'/../vendor/autoload.php';
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)){
    if (!empty($data['id']) and !empty($data['username'])) {
        $loggedInUser = \Hudutech\Controller\UserController::getLoggedInUser($username);
        if (!empty($loggedInUser)) {
            $loggedInUsername = $loggedInUser['username'];
            $deactivated = \Hudutech\Controller\UserController::deactivateAccount($data['id']);
            if ($deactivated && $loggedInUsername==htmlentities($data['username'])){
                print_r(json_encode(array(
                    "statusCode"=>200,
                    "message"=>"Account Deactivated Successfully!"
                )));
                unset($_SESSION['username']);
                session_destroy();
                header("Location: login.php");
            }
            if ($deactivated){
                print_r(json_encode(array(
                    "statusCode"=>200,
                    "message"=>"Account Deactivated Successfully!"
                )));
            }
            if (!$deactivated){
                print_r(json_encode(array(
                    "statusCode"=>500,
                    "message"=>"Internal Error Occurred Account Was Not Deactivated!"
                )));
            }
        }
    }else{
        print_r(json_encode(array(
            "statusCode"=>500,
            "message"=>"Unable to fetch required account data for this operation"
        )));
    }
}


