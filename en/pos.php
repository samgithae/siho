<?php
session_start();
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/8/17
 Prescribed23 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';

$counter = 1;
$cartCounter = 1;
$prescriptions = [];
$patient = [];


if (!empty($_POST['submit'])) {
    if (!empty($_POST['pNo']) && !isset($_SESSION['pNo'])) {
        if (!empty($_POST['pNo'])) {
            $_SESSION['pNo'] = $_POST['pNo'];
            unset($_POST);
            header('Location:' . $_SERVER['PHP_SELF']);
            $idObj = \Hudutech\Controller\PatientController::getPatientId($_SESSION['pNo']);
            if (!empty($idObj) && !isset($_SESSION['pId'])) {
                $pId = $idObj['id'];
                $_SESSION['pId'] = $pId;
            }
            if (!isset($_SESSION['receiptNo'])) {
                $_SESSION['receiptNo'] = \Hudutech\Controller\SalesController::generateReceiptNo();
            }

            unset($_POST);
        } else {
            unset($_POST);
        }
    } else {
        unset($_POST);

    }
}

$prescriptions = \Hudutech\Controller\DrugPrescriptionController::getPrescriptions($_SESSION['pId']);
$prescriptionSize = \Hudutech\Controller\DrugPrescriptionController::getPrescriptionCount($_SESSION['pId']);

$patient = \Hudutech\Controller\PatientController::getPatientId($_SESSION['pNo']);
$drugs = \Hudutech\Controller\DrugInventoryController::all();
$cart = \Hudutech\Controller\SalesController::showCartItems($_SESSION['receiptNo']);
$cartTotal = \Hudutech\Controller\SalesController::getCartTotal($_SESSION['receiptNo']);
$patientBill = \Hudutech\Controller\SalesController::getPatientBill($_SESSION['pId'], $_SESSION['receiptNo']);


?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <style>
        select {
            font-weight: bold;
        }
    </style>

</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="row">
<!--            <div class="col col-md-12" style="margin-bottom: 15px;">-->
<!--                <button class="btn btn-default" id="btnOverCounter" onclick="overCounter()"> Click Here To Sell Drugs Over the counter</button>-->
<!--            </div>-->
<!--        <hr/>-->
            <div class="col col-md-12" id="patientInfo">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="container-fluid">
                        <div class="form-horizontal" style="margin-bottom: 15px; padding: 10px;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" METHOD="POST">
                                <div class="form-inline">
                                    <label for="pNo">PatientNo</label>
                                    <input type="text" id="pNo" name="pNo" class="form-control"
                                           placeholder="Enter Patient Number">
                                    <input type="submit" name="submit" class="btn btn-primary btn-blue" value="Go">
                                </div>
                            </form>
                            <br><br>
                            <hr/>
                            <div class="pull-left">
                                <button class="btn btn-success btn-green" id="btnRefresh"> <i class="entypo-cw"></i>Refresh</button>
                            </div>
                        </div>


                        <?php if (!empty($patient)) { ?>
                            <div class="form-horizontal col-md-12" style="margin-bottom: 15px; padding: 10px;">
                                <form>
                                    <div class="form-group col-md-4">
                                        <label for="patient_No">OutPatient Number</label>
                                        <input type="text" id="patient_No" class="form-control"
                                               value="<?php echo isset($patient['patientNo']) ? $patient['patientNo'] : ''; ?>"
                                               disabled>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="patientName">Patient Name</label>
                                        <input type="text" id="patientName" class="form-control"
                                               value="<?php echo isset($patient['surName']) ? $patient['surName'] : ''; ?>"
                                               disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="patientName">Age</label>
                                        <input type="text" id="patientAge" class="form-control"
                                               value="<?php echo isset($patient['age']) ? $patient['age'] : ''; ?>"
                                               disabled>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="patientName">Location</label>
                                        <input type="text" id="patientName" class="form-control"
                                               value="<?php echo isset($patient['location']) ? $patient['location'] : '' ?>"
                                               disabled>

                                    </div>

                                </form>
                            </div>
                            <?php
                        } else {
                            echo "<br><br>No Patient Data found!";
                        }
                        ?>

                        <h3 style="margin-top: 15px;">Prescribed Drugs</h3>
                        <hr/>
                        <?php if (!empty($prescriptions)) {
                            ?>
                            <div class="table-responsive">

                                <table class="table table-stripped" id="prescriptionTable">
                                    <thead>
                                    <tr class="bg-success">
                                        <th>#</th>
                                        <th> Drug Name</th>
                                        <th> Drug Type</th>
                                        <th> Quantity</th>
                                        <th> Prescription</th>
                                        <th colspan="1"> Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($prescriptions as $presc): ?>
                                        <tr>
                                            <td><?php echo $counter++ ?></td>
                                            <td><?php echo $presc['drugName'] ?></td>
                                            <td><?php echo $presc['drugType'] ?></td>
                                            <td><?php echo $presc['quantity'] ?></td>
                                            <td><?php echo $presc['prescription'] ?></td>
                                            <td colspan="1">
                                                <button class="btn btn-danger btn-red"
                                                        onclick="markUnavailable('<?php echo $presc['id'] ?>')">Mark Not
                                                    Available
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                            <?php

                        } else {
                            echo "No Drug Prescriptions Found!";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

<?php if(sizeof($prescriptionSize) > 0){?>
        <div id="sellDrug" class="col-md-12">

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">
                                <h3>Sell Drug</h3>
                            </div>


                        </div>

                        <div class="panel-body">

                            <!--                   body content will start here-->

                            <div id="feedback"></div>

                            <form name="cartForm" id="cartForm">

                                <div class="form-group  col-md-5" style="padding: 5px; margin: 5px;">
                                    <label for="drug" style="padding-left: 10px;"
                                           class="control-label">Select Drug</label>

                                    <select class="form-control" name="drug" id="drug" data-width="auto">
                                        <?php foreach ($drugs as $drug): ?>
                                            <option value="<?php echo $drug['id'] ?>"><?php echo $drug['productName'] . " |QtyLeft[" . $drug['qtyInStock'] . "]"; ?></option>
                                        <?php endforeach; ?>

                                    </select>


                                </div>

                                <div class="form-group  col-md-3" style="padding: 5px; margin: 5px;">
                                    <label for="supplier" style="padding-left: 10px;"
                                           class="control-label">Quantity</label>

                                    <input type="number" class="form-control" name="qty" id="qty"
                                           placeholder="Quantity">


                                </div>
                            </form>
                            <div class="form-group col-md-2" style="padding-top: 30px;">
                                <button class="btn btn-success btn-green btn-md " id="addCart">Add to Cart</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">


                            </div>


                        </div>

                        <div class="panel-body">

                            <!--                   body content will start here-->


                            <div class="form-group  col-md-8" style="padding: 5px; margin: 5px;">
                                <ul class="list-group">
                                    <li class="list-group-item" style="font-size: 1.2em; font-weight: bold;">Registration Fee Ksh: <?php echo isset($patientBill['regFee']) ? $patientBill['regFee'].".00" : 0.00 ?></li>
                                    <li class="list-group-item" style="font-size: 1.2em; font-weight: bold;">Consultation Fee Ksh: <?php echo isset($patientBill['consultationFee']) ? $patientBill['consultationFee']. ".00" : 0.00?></li>
                                    <li class="list-group-item" style="font-size: 1.2em; font-weight: bold;">Clinical Test Fee Ksh: <?php echo isset($patientBill['testCost']) ? $patientBill['testCost']. ".00" : 0.00?></li>
                                </ul>

                                <label for="total" style="padding-left: 10px;"
                                       class="control-label">Total</label>
                                <div class="input-group">
                                    <span class="input-group-addon btn-success">KSH</span>
                                    <input type="text" class="form-control" value="<?php echo $patientBill['totalCost']+$cartTotal ?>" id="total"
                                           disabled>
                                    <span class="input-group-addon btn-success">.00</span>
                                </div>

                            </div>


                            <div class="form-group  col-md-8" style="padding: 5px; margin: 5px;">
                                <label for="amountPaid" style="padding-left: 10px;"
                                       class="control-label">Amount Paid</label>


                                <div class="input-group">
                                    <span class="input-group-addon btn-success">KSH</span>
                                    <input type="text" class="form-control" id="amtPaid" onkeyup="calculateBal()">
                                    <span class="input-group-addon btn-success">.00</span>
                                </div>

                            </div>

                            <div class="form-group  col-md-8" style="padding: 5px; margin: 5px;">
                                <label for="amountDue" style="padding-left: 10px;"
                                       class="control-label">Balance</label>


                                <div class="input-group">
                                    <span class="input-group-addon btn-success">KSH</span>
                                    <input type="text" class="form-control" id="balance" disabled>
                                    <span class="input-group-addon btn-success">.00</span>
                                </div>

                            </div>
                            <div class="form-group col-md-8 col-md-offset-3">
                                <button type="button" onclick="cartCheckout()" value="Check Out" id="checkOut"
                                        class="btn btn-green btn-lg control-label">Checkout
                                </button>

                            </div>
                            <div>
                            </div>


                            <!--                        body content will stop here-->
                        </div>

                    </div>

                </div>
                <div class="col-md-6">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">


                                <h3>Cart (Ksh <?php echo $cartTotal ?>.00)</h3>
                            </div>


                        </div>

                        <div class="panel-body">

                            <!--                   body content will start here-->


                            <div class="table-responsive">

                                <table class="table table-stripped" id="cartTable">
                                    <thead>
                                    <tr class="bg-success">
                                        <th>#</th>
                                        <th>Drug Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th colspan="1">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cart as $cartItem): ?>
                                        <tr>
                                            <td><?php echo $cartCounter++ ?></td>
                                            <td><?php echo $cartItem['productName'] ?></td>
                                            <td><?php echo $cartItem['qty'] ?></td>
                                            <td><?php echo $cartItem['price'] ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-danger btn-blue"
                                                        onclick=" removeFromCart('<?php echo $cartItem['id'] ?>')"><i
                                                            class="entypo-cancel"></i>Remove
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>


                                </table>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <?php } else{
    echo "<div class='alert alert-info'><i class='entypo-info' style='font-size: 1.4em;'></i>No Drug Prescriptions FOR Specified Patient. (<span style='color: red'>Cannot Make Drug Sale For Non Prescribed Patients</span>). </div>";
}
        ?>
    </div>
</div>

<!-- Modal 4 (Confirm)-->
<div class="modal fade" id="confirmDeleteModal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="confirmTitle">Confirm Action</h4>
                <div id="confirmFeedback">

                </div>
            </div>

            <div class="modal-body">
                <p style="font-size: 16px;"> Are you sure you want to Remove From Cart?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnConfirmDelete' class="btn btn-info">Continue</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end-->


<!-- Modal 4 (Confirm)-->
<div class="modal fade" id="confirmMark" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="confirmMarkTitle">Confirm Action</h4>
                <div id="confirmMarkFeedback">

                </div>
            </div>

            <div class="modal-body">
                <p style="font-size: 16px;"> Are you sure you want Mark This Drug as Unavailable?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnConfirmMark' class="btn btn-info">Continue</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end-->

<?php include 'footer_views.php' ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (e) {
        e.preventDefault;
//        $('#btnOverCounter').on('click', function () {
//            $('#sellDrug').hide();
//        });

        $('#addCart').on('click', function (event) {
            event.preventDefault;
            addToCart();
        });
        $('#btnRefresh').on('click', function () {
            refresh();
        });
        $('#checkOut').hide();
    })
</script>
<script>
    function refresh() {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            document.location = 'pos.php';
        };
        xhr.open('GET', 'refresh_endpoint.php', true);
        xhr.send();
    }

    function getData() {
        return {
            inventoryId: $('#drug').val(),
            qty: $('#qty').val()
        };
    }
    function addToCart() {
        var data = getData();
        data['pId'] = '<?php echo isset($_SESSION['pId'])?$_SESSION['pId']: "" ?>';
        data['receiptNo'] = '<?php echo isset($_SESSION['receiptNo']) ? $_SESSION['receiptNo']: "" ?>';
        var url = 'cart_endpoint.php';

        console.log(data);

        $.ajax(
            {
                type: 'POST',
                url: url,
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8;',
                success: function (response) {
                    console.log(response)
                    if (response.statusCode == 200) {
                        $('#feedback').removeClass('alert alert-danger')
                            .addClass('alert alert-success')
                            .text(response.message);
                        setTimeout(function () {
                            window.location.href = 'pos.php';
                        }, 1000)

                    }
                    if (response.statusCode == 500) {
                        $('#feedback').removeClass('alert alert-success')
                            .html('<div class="alert alert-danger alert-dismissable">' +
                                '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Error! </strong> ' + response.message + '</div>')

                    }

                }
            }
        );
    }
    function removeFromCart(id) {
        $('#confirmTitle').text('Remove Item');
        $('#confirmDeleteModal').modal('show');
        var url = 'cart_endpoint.php';
        $('#btnConfirmDelete').on('click', function (e) {
            e.preventDefault;
            $.ajax(
                {
                    type: 'DELETE',
                    url: url,
                    data: JSON.stringify({'id': id}),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        if (response.statusCode == 204) {
                            $('#confirmFeedback').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                window.location.href = 'pos.php';
                            }, 1000);
                        }
                        if (response.statusCode == 500) {
                            $('#confirmFeedback').removeClass('alert alert-success')
                                .html('<div class="alert alert-danger alert-dismissable">' +
                                    '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Error! </strong> ' + response.message + '</div>')

                        }
                    }
                }
            )
        });
    }

    function cartCheckout() {
        var url = 'checkout.php';
        var totalCost = '<?php echo $cartTotal ?>';
        console.log({cost: totalCost});
        $.ajax(
            {
                type: 'POST',
                url: url,
                data: JSON.stringify({cost: totalCost}),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8;',
                success: function (response) {
                    console.log(response);
                    if (response.statusCode == 200) {
                        $('#feedback').removeClass('alert alert-danger')
                            .addClass('alert alert-success')
                            .text(response.message);
                        setTimeout(function () {
                            window.location.href = 'pos.php';
                        }, 1000)

                    }
                    if (response.statusCode == 500) {
                        $('#feedback').removeClass('alert alert-success')
                            .html('<div class="alert alert-danger alert-dismissable">' +
                                '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Error! </strong> ' + response.message + '</div>')

                    }
                }
            }
        )
    }
    function markUnavailable(id) {
        var url = 'presc_endpoint.php';
        $('#confirmMark').modal('show');
        $('#btnConfirmMark').on('click', function () {
            $.ajax(
                {
                    type: 'POST',
                    url: url,
                    data: JSON.stringify({id: id}),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        if (response.statusCode == 200) {
                            $('#confirmMarkFeedback').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                window.location.href = 'pos.php';
                            }, 1000)

                        }
                        if (response.statusCode == 500) {
                            $('#confirmMarkFeedback').removeClass('alert alert-success')
                                .html('<div class="alert alert-danger alert-dismissable">' +
                                    '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Error! </strong> ' + response.message + '</div>');
                        }
                    }
                }
            )

        })
    }

    function calculateBal() {
        var cartTotal = parseFloat($('#total').val());
        var amtPaid = parseFloat($('#amtPaid').val());

        var bal = cartTotal - amtPaid;
        if (bal <=0){
            $('#balance').val(bal);
            $('#checkOut').show();
        }else{
            $('#balance').val(bal)
            $('#checkOut').hide();
        }

    }
</script>
</body>
</html>