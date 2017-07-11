<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/05/2017
 * Time: 22:22
 */
require_once __DIR__.'/../vendor/autoload.php';
include  __DIR__.'/includes/register_patient.inc.php';
?>
<!DOCTYPE>
<html>
<?php include 'head_views.php' ?>
<body class="page-body skin-facebook" >
<div class="page-container">

    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <?php include 'header_menu_views.php'?>

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">

                    <div class="panel-heading">
                        <div class="panel-title col-md-offset-3">

                            <?php
                            if(empty($success_msg) && !empty($error_msg)){
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $error_msg ?>
                                </div>
                                <?php
                            }
                            elseif(empty($error_msg) and !empty($success_msg)){
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $success_msg  ?>
                                </div>

                                <?php
                            }
                            else
                            {
                                echo "";
                            }
                            ?>
                            <h1>Register New Patient</h1>
                        </div>


                    </div>

                    <div class="panel-body">

                        <form role="form" class="form-horizontal form-groups-bordered" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">

                            <div class="form-group">
                                <label for="patientNo" class="col-sm-3 control-label">OutPatient Number</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="patientNo" placeholder="OutPatient Number ..." required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="fullName" class="col-sm-3 control-label">FullName</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="fullName" placeholder="FullName ..." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber" class="col-sm-3 control-label">Phone Number</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number ...">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Gender</label>
                                <div class="col-sm-5">
                                    <select name="sex" class="form-control">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="age" class="col-sm-3 control-label">Age</label>

                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="age" placeholder="Age ..." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location" class="col-sm-3 control-label">Location</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="location" placeholder="Location" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Patient Type</label>
                                <div class="col-sm-5">
                                    <select name="patientType" class="form-control">
                                        <option value="out_patient">Out Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">

                                    <input type="submit" name="submit " value="Register Patient" class="btn btn-primary btn-lg btn-block "/>
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
