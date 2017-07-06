<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 04/05/2017
 * Time: 08:28
 */
$error_msg = "";
$success_msg = "";
if (isset($_SESSION['username'])) {
    header("Location: ../index44.php");
}
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $authenticated = \Hudutech\Controller\UserController::authenticate($username, $password);

        if (isset($authenticated['success'])) {
            $success_msg .= "Login Successful";
            $user = \Hudutech\Controller\UserController::getLoggedInUser($username);
            $_SESSION['userLevel'] = $user['userLevel'];
            $_SESSION['username'] = $username;
            header("Location: ../index44.php");

        } elseif(isset($authenticated['error'])){
            $error_msg .= $authenticated['error'];
        }
    } else {
        $error_msg .= "username and password required";
    }
}