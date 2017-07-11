<?php
session_start();
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/10/17
 * Time: 8:13 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$id = '';
$patientId = '';
$patient = [];
$recommendedDrugs = [];
if (isset($_GET['id'])) {
    $_SESSION['patientId'] = $_GET['id'];
    $patientId = $_SESSION['patientId'];

    $patient = \Hudutech\Controller\ClinicalNoteController::getPatientFromClinicalNotes($patientId);

}
$recommendedDrugs = \Hudutech\Controller\DrugPrescriptionController::getPrescriptions($_SESSION['patientId']);
$counter = 1;

?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>Recommend Drugs</title>
    <style>
        th {
            color: #000000;
            font-size: 1.6em;
        }

        td {
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
        <?php
        if (!empty($patient)){

        ?>
        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title col-md-offset-3">
                    <h1>Recommend Drugs</h1>
                </div>
            </div>

            <div class="row" style="margin: 5px;">
                <div class="col col-md-10">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h3>Patient Information</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-success">
                                    <th>PatientNo</th>
                                    <th>Patient Name</th>
                                    <th>Sex</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $patient['patientNo'] ?></td>
                                    <td><?php echo $patient['surName'] . " " . $patient['firstName'] . " " . $patient['otherName'] ?></td>
                                    <td><?php echo $patient['sex'] ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row" style="margin: 5px;">
                <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">
                                <div id="feedback">

                                </div>

                                <h3> Add Drugs</h3>

                            </div>


                        </div>

                        <div class="panel-body ">

                            <!--                   body content will start here-->


                            <form role="form" class="form-groups-bordered">
                                <div class="row  container-fluid">

                                    <input type="hidden" id="patientNoHidden"
                                           value="<?php echo $patientId; ?>">
                                    <div class="form-group col-md-3 col-md-3" style="padding: 5px; margin: 5px;">
                                        <label for="drugName" style="padding-left: 10px;" class="control-label">Drug
                                            Name</label>


                                        <input type="text" class="form-control" id="drugName" name="drugName"
                                               placeholder="Drug Name">

                                    </div>
                                    <div class="form-group col-md-2 col-md-2" style="padding: 5px; margin: 5px;">
                                        <label for="type" style="padding-left: 10px;" class="control-label">Administration
                                            Type</label>


                                        <select name="drugType" id="drugType" class="form-control form-horizontal ">
                                            <option>Tablet</option>
                                            <option>Liquid</option>
                                            <option>Capsules</option>
                                            <option>Injections</option>
                                            <option>Topical medicines</option>
                                            <option>Drops</option>
                                            <option>Inhalers</option>
                                            <option>Suppositories</option>
                                            <option>Implants</option>
                                            <option>Buccal</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1 col-md-1" style="padding: 5px; margin: 5px;">
                                        <label for="dosage" style="padding-left: 10px;"
                                               class="control-label">Dosage</label>


                                        <input type="text" class="form-control" name="quantity" id="quantity"
                                               placeholder="Dosage">

                                    </div>
                                    <div class="form-group col-md-3 col-md-3"
                                         style=" display:table;padding: 5px; margin: 5px;">
                                        <label for="prescription1" style=" width:100%; padding-right: 50%"
                                               class="control-label">Drug Prescription</label>

                                        <select style="width:65px;" id="prescription1"
                                                class="form-control form-horizontal col-md-1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>

                                        <label for="*" style=" width:20px; font-size: xx-large;"
                                               class="control-label form-horizontal col-md-1">*</label>


                                        <select style="width:60px; margin-left: 10px;" id="prescription3"
                                                class="form-control form-horizontal col-md-1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-1 " style="padding: 5px;margin: 5px;">
                                        <label for="dosage" style="padding-left: 1px;"
                                               class="control-label">Duration</label>


                                        <input type="number" class="form-control" name="duration" id="duration"
                                               placeholder="in days">

                                    </div>

                                    <div class="form-group col-md-1 col-md-1" style="margin-top:30px; ">
                                        <!--    buttons-->

                                        <input value="Add" id="add" onclick="submitFormData()"
                                               class="btn btn-green  btn-md"
                                               type="button">

                                    </div>


                                </div>


                            </form>


                            <!--                        body content will stop here-->
                        </div>

                    </div>

                </div>
            </div>

           <?php } else echo "No Patient Data found try again." ?>

            <div class="row" style="margin: 5px;">
                <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">


                                <h3> Prescribed Drugs</h3>

                            </div>


                        </div>

                        <div class="panel-body ">

                            <!--                   body content will start here-->

                            <form role="form" class="form-horizontal form-groups-bordered">


                                <div class="col-md-10">
                                    <div class="table-responsive">
                                    <h4>Prescription Details</h4>

                                    <table class="table  table-condensed table-bordered " id="queueTable">
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Drug Name</th>
                                            <th>Drug Type</th>
                                            <th>Quantity</th>
                                            <th>Prescription</th>
                                            <th>Duration</th>
<!--                                            <th>Action</th>-->

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($recommendedDrugs as $recommendedDrug): ?>
                                            <tr>

                                                <td><?php echo $counter++ ?></td>
                                                <td><?php echo $recommendedDrug['drugName'] ?></td>
                                                <td><?php echo $recommendedDrug['drugType'] ?></td>
                                                <td><?php echo $recommendedDrug['quantity'] ?></td>
                                                <td><?php echo $recommendedDrug['prescription'] ?></td>
                                                <td><?php echo $recommendedDrug['duration'] ?></td>
<!--                                                <td><a href="delete_presc.php?id=--><?php //echo $recommendedDrug['id'];?><!--" class="btn-link" style="color: red;">Delete Link</a> </td>-->
                                            </tr>
                                        <?php endforeach; ?>


                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                            </form>


                            <!--                        body content will stop here-->
                        </div>

                    </div>

                </div>
            </div>

            <div class="row" style="margin: 5px;">
                <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">


                                <div class="col-md-3 col-md-offset-2">
                                    <!--    buttons-->

                                    <button id="btn-add-test" onclick="redirectToConsultation()"
                                            class="btn btn-green   btn-lg">Send To Pharmacy
                                    </button>


                                </div>

                            </div>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer_views.php' ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>

<script>

    function getFormData() {
        return {
            patientId: $("#patientNoHidden").val(),
            drugName: $("#drugName").val(),
            drugType: $("#drugType").val(),
            quantity: $("#quantity").val(),

            prescription1: $("#prescription1").val(),

            prescription3: $("#prescription3").val(),
            duration: $("#duration").val()

        }

    }
    function submitFormData() {

        var url = 'recommend_drug_endpoint.php';
        var data = getFormData();
        console.log(data);
        $.ajax(
            {
                type: 'POST',
                url: url,
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function (response) {
                    console.log(response);
                    if (response.statusCode == 200) {
                        $('#feedback').removeClass('alert alert-danger')
                            .addClass('alert alert-success')
                            .text(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                        $('#patientNoHidden').val('');
                    }
                    if (response.statusCode == 500) {
                        $('#feedback').removeClass('alert alert-success')
                            .addClass('alert alert-danger')
                            .text(response.message);
                        $('#patientNoHidden').val('');
//                        setTimeout(function () {
//                           location.reload();
//                        }, 1000);
                    }
                }

            }
        )

    }

    function redirectToConsultation() {
        <?php
        \Hudutech\Controller\PatientVisitController::markAsLeft($patientId);
        unset($_SESSION['patientId']);
        ?>
        setTimeout(function () {
            window.location.href = 'consultation.php';
        }, 1000);

    }


</script>
</body>
</html>