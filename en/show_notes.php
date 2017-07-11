<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/07/2017
 * Time: 23:33
 */
require_once __DIR__.'/../vendor/autoload.php';
$counter = 1;
$notes = \Hudutech\Controller\ClinicalNoteController::getAllClinicalNoteByPatientId($_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <style>
        /*    --------------------------------------------------
	:: General
	-------------------------------------------------- */
        body {
            font-family: 'Open Sans', sans-serif;
            color: #353535;
        }
        .content h1 {
            text-align: center;
        }
        .content .content-footer p {
            color: #6d6d6d;
            font-size: 12px;
            text-align: center;
        }
        .content .content-footer p a {
            color: inherit;
            font-weight: bold;
        }

        /*	--------------------------------------------------
            :: Table Filter
            -------------------------------------------------- */
        .panel {
            border: 1px solid #ddd;
            background-color: #fcfcfc;
        }
        .panel .btn-group {
            margin: 15px 0 30px;
        }
        .panel .btn-group .btn {
            transition: background-color .3s ease;
        }
        .table-filter {
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }
        .table-filter tbody tr:hover {
            cursor: pointer;
            background-color: #eee;
        }
        .table-filter tbody tr td {
            padding: 10px;
            vertical-align: middle;
            border-top-color: #eee;
        }
        .table-filter tbody tr.selected td {
            background-color: #eee;
        }
        .table-filter tr td:first-child {
            width: 38px;
        }
        .table-filter tr td:nth-child(2) {
            width: 35px;
        }
        .ckbox {
            position: relative;
        }
        .ckbox input[type="checkbox"] {
            opacity: 0;
        }
        .ckbox label {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .ckbox label:before {
            content: '';
            top: 1px;
            left: 0;
            width: 18px;
            height: 18px;
            display: block;
            position: absolute;
            border-radius: 2px;
            border: 1px solid #bbb;
            background-color: #fff;
        }
        .ckbox input[type="checkbox"]:checked + label:before {
            border-color: #2BBCDE;
            background-color: #2BBCDE;
        }
        .ckbox input[type="checkbox"]:checked + label:after {
            top: 3px;
            left: 3.5px;
            content: '\e013';
            color: #fff;
            font-size: 11px;
            font-family: 'Glyphicons Halflings';
            position: absolute;
        }
        .table-filter .star {
            color: #ccc;
            text-align: center;
            display: block;
        }
        .table-filter .star.star-checked {
            color: #F0AD4E;
        }
        .table-filter .star:hover {
            color: #ccc;
        }
        .table-filter .star.star-checked:hover {
            color: #F0AD4E;
        }
        .table-filter .media-photo {
            width: 35px;
        }
        .table-filter .media-body {
            /*display: block;*/
            /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
        }
        .table-filter .media-meta {
            font-size: 11px;
            color: #999;
        }
        .table-filter .media .title {
            color: #2BBCDE;
            font-size: 14px;
            font-weight: bold;
            line-height: normal;
            margin: 0;
        }
        .table-filter .media .title span {
            font-size: .8em;
            margin-right: 20px;
        }
        .table-filter .media .title span.pagado {
            color: #5cb85c;
        }
        .table-filter .media .title span.pendiente {
            color: #f0ad4e;
        }
        .table-filter .media .title span.cancelado {
            color: #d9534f;
        }
        .table-filter .media .summary {
            font-size: 14px;
        }
    </style>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="row">


                <div class="container">

                    <div class="row">

                        <section class="content">
                            <h1>Patient History</h1>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-filter" data-target="complaint">Complaints</button>
                                                <button type="button" class="btn btn-warning btn-filter" data-target="complaintHistory">Complaints History</button>
                                                <button type="button" class="btn btn-danger btn-filter" data-target="familySocialHistory">Family Social History</button>
                                                <button type="button" class="btn btn-default btn-filter" data-target="physicalExamination">Physical Examination</button>
                                                <button type="button" class="btn btn-success btn-filter" data-target="diagnosis">Diagnosis</button>
                                            </div>
                                        </div>
                                        <div class="container-fluid  " style="margin-top: 15px;">
                                        <div class="table-container ">
                                            <table class=" table table-filter  ">
                                                <tbody>
                                                <?php foreach ($notes as $note): ?>
                                                <tr data-status="complaint">
                                                    <td><a href="#" class="pull-left">
                                                            <i class="fa fa-plus-square media-photo text-success "  style="font-size:48px;"></i>
                                                        </a></td>
                                                    <td><h4 class="title"><?php echo $note['date']?></h4></td>


                                                    <td>
                                                        <div class="media ">

                                                            <div class="media-body">
                                                                <h4 class="title">

                                                                    <span class="pull-right pagado">(Physical Examination)</span>
                                                                </h4>
                                                                <p class="summary"><?php echo $note['complaint']?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php foreach ($notes as $note): ?>
                                                <tr data-status="complaintHistory">


                                                    <td><a href="#" class="pull-left">
                                                            <i class="fa fa-plus-square media-photo  "  style="font-size:48px; color: #e5e500"></i>
                                                        </a></td>
                                                    <td><h4 class="title"><?php echo $note['date']?></h4></td>
                                                    <td>
                                                        <div class="media">

                                                            <div class="media-body">

                                                                <h4 class="title">

                                                                    <span class="pull-right pendiente">(complaintHistory)</span>
                                                                </h4>
                                                                <p class="summary"><?php echo $note['complaintHistory']?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php foreach ($notes as $note): ?>
                                                <tr data-status="familySocialHistory">
                                                    <td><a href="#" class="pull-left">
                                                            <i class="fa fa-plus-square  media-photo text-danger "  style="font-size:48px;"></i>
                                                        </a></td>
                                                    <td><h4 class="title"><?php echo $note['date']?></h4></td>
                                                    <td>
                                                        <div class="media">

                                                            <div class="media-body">

                                                                <h4 class="title">

                                                                    <span class="pull-right cancelado">(family Social History)</span>
                                                                </h4>
                                                                <p class="summary"><?php echo $note['familySocialHistory']?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php foreach ($notes as $note): ?>
                                                <tr data-status="physicalExamination" class="selected">
                                                    <td><a href="#" class="pull-left">
                                                            <i class="fa fa-plus-square media-photo btn-default"  style="font-size:48px;"></i>
                                                        </a></td>
                                                    <td><h4 class="title"><?php echo $note['date']?></h4></td>
                                                    <td>
                                                        <div class="media">

                                                            <div class="media-body">

                                                                <h4 class="title">

                                                                    <span class="pull-right pendiente">(Physical Examination)</span>
                                                                </h4>
                                                                <p class="summary"><?php echo $note['familySocialHistory']?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php foreach ($notes as $note): ?>
                                                <tr data-status="diagnosis">
                                                    <td><a href="#" class="pull-left">
                                                            <i class="fa fa-plus-square media-photo text-success "  style="font-size:48px;"></i>
                                                        </a></td>
                                                    <td ><h4 class="title"><?php echo $note['date']?></h4></td>

                                                    <td>
                                                        <div class="media">

                                                            <div class="media-body">
                                                                 <h4 class="title">

                                                                    <span class="pull-right  pagado">(Diagnosis)</span>
                                                                </h4>
                                                                <p class="summary"><?php echo $note['diagnosis']?></p>
                                                            </div>
                                                        </div>
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
                        </section>

                    </div>

                </div>

        </div>
    </div>
</div>


<?php include "footer_views.php"; ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script src="../public/assets/js/paginator/jquery.paginate.min.js"></script>
<script>
    $(document).ready(function () {

        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });

    });
</script>
</body>
</html>

