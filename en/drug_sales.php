<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/19/17
 * Time: 11:29 AM
 */
require_once __DIR__.'/../vendor/autoload.php';
$counter = 1;
$sales = \Hudutech\Controller\SalesController::showSales();


?>


<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>iClinic |Drug Sales Log</title>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="container-fluid">
                <div class="row" style="margin-top: 15px;">
                </div>
                <div class="col col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                        <table class="table table-bordered" id="salesTable">
                            <h3>Showing Drug Sales Log</h3>
                            <hr/>
                            <thead>
                            <tr class="bg-info">
                                <th>#</th>
                                <th style="color: black">ReceiptNo</th>
                                <th style="color: black">DrugName</th>
                                <th style="color: black">Price</th>
                                <th style="color: black">Quantity Sold</th>
                                <th style="color: black">Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sales as $sale): ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $sale['receiptNo']?></td>
                                    <td><?php echo $sale['productName']?></td>
                                    <td><?php echo $sale['price']?></td>
                                    <td><?php echo $sale['qty']?></td>
                                    <td><?php echo $sale['datePurchased']?></td>
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
</div>

<!--end-->

<?php include "footer_views.php"; ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script src="../public/assets/js/paginator/jquery.paginate.min.js"></script>
<script>
    $(document).ready(function (e) {
       e.preventDefault;
        var prefix = 'paginate';
        $('#salesTable').paginate({
            'maxButtons': 10,
            'elemsPerPage': 10,
            'disabledClass': prefix + 'Disabled',
            'activeClass': prefix + 'Active',
            'containerClass': prefix + 'Container',
            'listClass': prefix + 'List',
            'showAllListClass': prefix + 'ShowAllList',
            'previousClass': prefix + 'Previous',
            'nextClass': prefix + 'Next',
            'previousSetClass': prefix + 'PreviousSet',
            'nextSetClass': prefix + 'NextSet',
            'showAllClass': prefix + 'ShowAll',
            'pageClass': prefix + 'Page',
            'anchorClass': prefix + 'Anchor'

        });
    })

</script>
</body>
</html>
