<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/05/2017
 * Time: 22:22
 */
require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/includes/register_user.inc.php';
?>
<!DOCTYPE html>
<html>
<?php include 'head_views.php' ?>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <?php include 'header_menu_views.php' ?>
                <div class="panel panel-primary" data-collapsed="0">

                    <div class="panel-heading">
                        <div class="panel-title col-md-offset-3">

                            <?php
                            if (empty($success_msg) && !empty($error_msg)) {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $error_msg ?>
                                </div>
                                <?php
                            } elseif (empty($error_msg) and !empty($success_msg)) {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $success_msg ?>
                                </div>

                                <?php
                            } else {
                                echo "";
                            }
                            ?>
                            <h1>Register User</h1>
                        </div>


                    </div>

                    <div class="panel-body">

                        <form role="form" class="form-horizontal form-groups-bordered" method="post"
                              action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                            <div class="form-group">
                                <label for="firstName" class="col-sm-3 control-label">First Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Last Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="userName" class="col-sm-3 control-label">UserName</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select User Level</label>

                                <div class="col-sm-5">
                                    <select name="userLevel" class="form-control">
                                        <option>admin</option>
                                        <option>receptionist</option>
                                        <option>doctor</option>
                                        <option>lab_technician</option>
                                        <option>pharmacist</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirmpassword" class="col-sm-3 control-label">Confirm Password</label>

                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm"
                                           placeholder="Confirm Password" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">

                                    <input type="submit" name="submit" value="Register User"
                                           class="btn btn-primary btn-lg btn-block "/>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php include 'footer_views.php'?>
    <script src="../public/assets/js/jquery-1.11.3.min.js"></script>
    <script src="../public/assets/js/bootstrap.min.js"></script>
</body>
</html>
