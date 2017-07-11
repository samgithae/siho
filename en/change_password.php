<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/22/17
 * Time: 12:54 AM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$error = '';
$success = '';
if (
!empty($_POST['username'])and
!empty($_POST['old_password']) and
!empty($_POST['new_password']) and
!empty($_POST['confirm_password'])
){
    if (htmlentities($_POST['new_password']) == htmlentities($_POST['confirm_password'])) {
        $username = htmlentities($_POST['username']);
        $oldPassword = htmlentities($_POST['old_password']);
        $newPassword = htmlentities($_POST['confirm_password']);
        $auth = \Hudutech\Controller\UserController::authenticate($username, $oldPassword);
        if (array_key_exists("success", $auth)) {
            // an active account exists.
            //so we can proceed and change the password.
            $changed = \Hudutech\Controller\UserController::changePassword($username, $newPassword);
            if ($changed) {
                $success .="Password Changed Successfully";
                header('Location: '.$_SERVER['PHP_SELF']);
            }else{
                $error .="Internal Error Occurred Password not changed";
            }
        }
        else{
            $error .="Could not find active account matching the credentials provided!.";
        }
    }else{
        $error .="Passwords Do Not Match";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="row">

            <div class="col col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="container-fluid" style="margin: 15px;">
                        <div class="col-md-8 col-xs-9 col-md-offset-2">
                            <?php
                            if($error != '' and $success == ''){
                                echo "<div class='alert alert-danger'>".$error."</div>";
                            }elseif($success !='' and $error== ''){
                                echo "<div class='alert alert-success'>".$success."</div>";
                            }
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                <div class="form-group">
                                    <label class="control-label" for="username">Username</label>
                                    <input type="text" name="username"
                                           value="<?php echo htmlentities(isset($_GET['username']) ? $_GET['username']: '') ?>"
                                           class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="old_password"><i class="entypo-lock"></i>Old
                                        Password</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="new_password"><i class="entypo-lock"></i>New
                                        Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="confirm_password"><i class="entypo-lock"></i>Confirm
                                        New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                           class="form-control">
                                </div>
                                <div>
                                    <input type="submit" value="Change Password" class="btn btn-primary btn-blue">
                                    <a href="users.php" class="pull-right " style="color: blue!important;">Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

