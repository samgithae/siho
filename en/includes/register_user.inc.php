<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 04/05/2017
 * Time: 08:55
 */
$success_msg= "";
$error_msg= "";


if(!empty($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['userLevel']) && isset($_POST['password']) && isset($_POST['confirm'])) {

        if ($_POST['password'] == $_POST['confirm']) {
            $user = new \Hudutech\Entity\User();

            $user->setFirstName($_POST['firstName']);
            $user->setLastName(($_POST['lastName']));
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);

            $user->setUserLevel($_POST['userLevel']);
            $user->setPassword($_POST['password']);
            $user->setActive(true);
            $userController = new \Hudutech\Controller\UserController();
            if ($userController->create($user)) {
                $success_msg .= "User saved successfully";
            } else {
                $error_msg .= 'error saving user, please try again ';
            }
        } else {
            $error_msg .= "password does not match";
        }
    } else {

        $error_msg .= 'All fields required';
    }
}