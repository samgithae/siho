<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/12/17
 * Time: 3:23 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';
$patientId = '';
$patientTest = null;
$counter = 1;
$patient = null;
if (isset($_POST['patientNo'])) {
    if (!empty($_POST['patientNo'])) {
        $_SESSION['patientNo'] = $_POST['patientNo'];
        $idObj = \Hudutech\Controller\PatientController::getPatientId($_SESSION['patientNo']);
        if (!empty($idObj)){
            $patientId = $idObj['id'];
        }
        $patientTests = \Hudutech\Controller\PatientClinicalTestController::showClinicalTestResults($patientId);
        $patient = \Hudutech\Controller\PatientController::getPatientId($_SESSION['patientNo']);

        unset($_POST);
    }else{
        unset($_POST);
    }
}else{
    unset($_POST);

}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
<style>
    td, th, label, input, option {
        color: #000000;
        font-size: 1.4em;
    }
</style>
</head>
<body class="page-body skin-facebook">
<div class="page-container">

    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <hr>
        <div class="row">
            <div id="mainFeedback"></div>
            <div class="col col-md-10">
                <div class="panel-body">
                    <form class="form-inline" method="post"
                          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="form-group">
                            <label for="patientNo" class="control-label">PatientNo</label>
                            <input type="text" id="patientNo" name="patientNo" class="form-control" required>
                        </div>
                        <input type="submit"  value="Show Tests" class="btn btn-primary btn-blue">

                    </form>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col col-md-10">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h3>Patient Info</h3>
                        <?php if(!empty($patient)) {
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-success">
                                    <th style="color: #000000;">PatientNo</th>
                                    <th style="color: #000000;">Patient Name</th>
                                    <th style="color: #000000;">Sex</th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr>
                                    <td style="color: #000000;"><?php echo $patient['patientNo'] ?></td>
                                    <td style="color: #000000;"><?php echo $patient['surName'] . " " . $patient['firstName'] . " " . $patient['otherName'] ?></td>
                                    <td style="color: #000000;"><?php echo $patient['sex'] ?></td>
                                </tr>

                                </tbody>
                            </table>
                            <?php
                        }else{
                            echo "No Patient Test Detail Found";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col col-md-12">
                <div class="container-fluid">
                    <?php if (!empty($patientTests)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TestName</th>
                                    <th>Result</th>
                                    <th>Extra Notes</th>
                                    <th>Completed</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  foreach ($patientTests as $patientTest): ?>
                                    <tr>
                                        <th><?php echo $counter++ ?></th>
                                        <th><?php echo $patientTest['testName'] ?></th>
                                        <th><?php echo $patientTest['testResult'] ?></th>
                                        <th>
                                            <?php
                                            if (is_null($patientTest['description'])) {
                                                echo "---";
                                            } else {
                                                echo $patientTest['description'];
                                            }
                                            ?>
                                        </th>
                                        <th><?php
                                            if ($patientTest['isPerformed'] == 0) {
                                                echo "<i class='entypo-cancel' style='color: red;'></i>";
                                            } elseif ($patientTest['isPerformed'] == 1) {
                                                echo "<i class='entypo-check' style='color: green;'></i>";
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5">
                                        <a href="recommend_drug.php?id=<?php echo $patientId?>" target="_blank" class="btn btn-primary btn-blue pull-right">Recommend Drugs<a/>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <?php
                    } else {
                        echo "<h4> No Test Results found!</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--END -->
<?php include 'footer_views.php' ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (e) {
        e.preventDefault;
    })
</script>

<script type="text/javascript">

</script>
</body>
</html>