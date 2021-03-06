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


    $products = \Hudutech\Controller\ProductInventoryController::all();

$counter = 1;

?>
<!DOCTYPE html>
<html>
<head>


    <

    <?php include 'head_views.php' ?>
    <title>Add Product</title>
    <style>
        th {
            color: #000000;
            font-size: 1.5em;
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

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title col-md-offset-3">
                    <h1>Add Product</h1>
                </div>
            </div>


            <div class="row" style="margin: 5px;">
                <div class="col-md-12">

                    <div class="panel panel-primary" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title col-md-offset-3">
                                <div id="feedback">

                                </div>

                                <h3>Product Information</h3>

                            </div>


                        </div>

                        <div class="panel-body ">

                            <!--                   body content will start here-->


                            <form role="form" class="form-groups-bordered">
                                <div class="row  container-fluid">


                                    <div class="form-group  col-md-3" style="padding: 5px; margin: 5px;">
                                        <label for="batchNo" style="padding-left: 10px;" class="control-label">Batch
                                            No</label>


                                        <input type="text" class="form-control" id="batchNo" name="batchNo"
                                               placeholder="Batch No">

                                    </div>

                                    <div class="form-group col-md-3" style="padding: 5px; margin: 5px;">
                                        <label for="invoiceNo" style="padding-left: 10px;"
                                               class="control-label">Invoice No</label>


                                        <input type="text" class="form-control" name="invoiceNo" id="invoiceNo"
                                               placeholder="InvoiceNo">

                                    </div>
                                    <div class="form-group  col-md-3" style="padding: 5px; margin: 5px;">
                                        <label for="productName" style="padding-left: 10px;"
                                               class="control-label">Product Name</label>


                                        <input type="text" class="form-control" name="productName" id="productName"
                                               placeholder="productName">

                                    </div>

                                    <div class="form-group  col-md-2" style="padding: 5px; margin: 5px;">
                                        <label for="qtyReceived" style="padding-left: 10px;"
                                               class="control-label">Quantity Received</label>


                                        <input type="text" class="form-control" name="qtyReceived" id="qtyReceived"
                                               placeholder="Quantity Received">

                                    </div>

                                    <div class="form-group  col-md-3" style="padding: 5px; margin: 5px;">
                                        <label for="supplier" style="padding-left: 10px;"
                                               class="control-label">Supplier</label>


                                        <input type="text" class="form-control" name="supplier" id="supplier"
                                               placeholder="Supplier">

                                    </div>

                                    <div class="form-group  col-md-2" style="padding: 5px; margin: 5px;">
                                        <label for="purchasePrice" style="padding-left: 10px;"
                                               class="control-label">Purchase Price</label>


                                        <input type="text" class="form-control" name="purchasePrice" id="purchasePrice"
                                               placeholder="Purchase Price">

                                    </div>

                                    <div class="form-group  col-md-2" style="padding: 5px; margin: 5px;">
                                        <label for="salePrice" style="padding-left: 10px;"
                                               class="control-label">Sale Price</label>


                                        <input type="text" class="form-control" name="salePrice" id="salePrice"
                                               placeholder="Sale Price">

                                    </div>




                                    <div class="form-group col-md-2" style="padding: 5px; margin: 5px;">
                                        <label style="padding-left: 10px;"
                                               class="control-label">Purchase Date</label>


                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="purchaseDate"
                                                   id="purchaseDate">

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-2" style="padding: 5px; margin: 5px;">
                                        <label style="padding-left: 10px;"
                                               class="control-label">Expiry Date</label>


                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="expiryDate"
                                                   id="expiryDate">

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group col-md-2" >
                                        <!--    buttons-->

                                        <input value="Add Product" id="add" onclick="submitData()"
                                               class="btn btn-green btn-lg control-label"
                                               type="button"/>

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


                                <h3>Product Inventory</h3>

                            </div>


                        </div>

                        <div class="panel-body ">

                            <!--                   body content will start here-->

                            <form role="form" class="form-horizontal form-groups-bordered">


                                <div class="col-md-12">



                                    <table class="table table-condensed table-bordered " id="queueTable">
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Batch No</th>
                                            <th>Invoice No</th>
                                            <th>Product Name</th>
                                            <th>Quantity Received</th>
                                            <th>Supplier</th>
                                            <th>purchase Price</th>
                                            <th>Sale Price</th>
                                            <th>Purchase Date</th>
                                            <th>Expiry Date</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($products as $product): ?>
                                            <tr>

                                                <td><?php echo $counter++ ?></td>
                                                <td><?php echo $product['batchNo'] ?></td>
                                                <td><?php echo $product['invoiceNo'] ?></td>
                                                <td><?php echo $product['productName'] ?></td>
                                                <td><?php echo $product['qtyReceived'] ?></td>
                                                <td><?php echo $product['supplier'] ?></td>
                                                <td><?php echo $product['purchasePrice'] ?></td>
                                                <td><?php echo $product['salePrice'] ?></td>
                                                <td><?php echo $product['purchaseDate'] ?></td>
                                                <td><?php echo $product['expiryDate'] ?></td>

                                            </tr>
                                        <?php endforeach; ?>


                                        </tbody>
                                    </table>

                                </div>

                            </form>


                            <!--                        body content will stop here-->
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<?php include 'footer_views.php'; ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>

<!-- Imported scripts on this page -->

<script src="../public/assets/js/bootstrap-datepicker.js"></script>


<script type="text/javascript">

    function getFormData() {
        return {
            batchNo: $("#batchNo").val(),
            invoiceNo: $("#invoiceNo").val(),
            productName: $("#productName").val(),
            qtyReceived: $("#qtyReceived").val(),
            supplier: $("#supplier").val(),
            purchasePrice: $("#purchasePrice").val(),
            salePrice: $("#salePrice").val(),
            purchaseDate: $("#purchaseDate").val(),
            expiryDate: $("#expiryDate").val()

        }

    }
    function submitData() {

        var url = 'record_product_endpoint.php';
        var data = getFormData();
        //console.log(data);
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

                    }
                   else if (response.statusCode == 500) {
                        $('#feedback').removeClass('alert alert-success')
                            .addClass('alert alert-danger')
                            .text(response.message);

//                        setTimeout(function () {
//                           location.reload();
//                        }, 1000);
                    }
                },
                error: function (error) {
                    console.log(error);
                }

            }
        )

    }


</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#expiryDate').datepicker({
            format: "yyyy-mm-dd"
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#purchaseDate').datepicker({
            format: "yyyy-mm-dd"
        });
    });
</script>
</body>
</html>