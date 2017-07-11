<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/9/17
 * Time: 10:59 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

$clinicalTests = \Hudutech\Controller\ClinicalTestController::all();
$counter = 1;

?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'head_views.php' ;?>
    <title>Clinical Tests</title>
    <style>
        th,thead, td{
            font-size: 1.2em;
            color: black;
        }
    </style>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <?php include 'header_menu_views.php'?>
        <div class="row">
            <div class="col col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                <div class="container-fluid" style="margin-top: 15px;">
                    <h5 class="center" style="font-size: 1.2em">Available Clinical Tests</h5>
                    <hr/>
                    <div class="col-md-12 table-responsive">
                        <div id="addNew" style="margin-bottom: 15px;" class="clearfix pull-left">
                            <button class="btn btn-primary btn-blue" onclick="showModal()">Add New</button>
                        </div>
                        <table class="table table-condensed table-bordered" id="testTable">
                            <thead>
                            <tr class="bg-success">
                                <th>#</th>
                                <th>Test Name</th>
                                <th>Cost(Ksh)</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($clinicalTests as $clinicalTest): ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $clinicalTest['testName'] ?></td>
                                    <td><?php echo $clinicalTest['cost'] ?></td>
                                    <td colspan="2">
                                        <button class="btn btn-default btn-sm btn-icon icon-left"
                                                onclick="updateTest('<?php echo $clinicalTest['id'] ?>', '<?php echo $clinicalTest['testName'] ?>', '<?php echo $clinicalTest['cost']?>')">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm btn-icon icon-left"
                                                onclick="deleteTest('<?php echo $clinicalTest['id'] ?>')">
                                            <i class="entypo-cancel"></i>
                                            Delete
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
</div>

<div class="modal fade" id="testModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="addTestTitle">Add NEW TESTS</h4>
                <div id="feedbackMessage"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="testName" class="control-label">Test Name</label>

                            <input type="text" class="form-control" id="testName" placeholder="Name of the test">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="testCost" class="control-label">Test Cost</label>
                            <input type="hidden" id="testId">
                            <input type="number" class="form-control" id="testCost"
                                   placeholder="Cost of the test in Ksh ..." required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-add" class="btn btn-info" onclick="addNewTest()">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4 (Confirm)-->
<div class="modal fade" id="confirmDeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Confirm Action</h4>
            </div>
            <div id="confirmFeedback">
            </div>
            <div class="modal-body">

                <p style="font-size: 16px;">Click Continue to delete</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnConfirmDelete' class="btn btn-danger">Delete</button>
                <button type="button" id='btnConfirmDelete' class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer_views.php'?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script src="../public/assets/js/paginator/jquery.paginate.min.js"></script>

<script>
    jQuery(document).ready(function (e) {
        e.preventDefault;
        var prefix = 'paginate';
        $('#testTable').paginate({
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
<script>
    function getModalData() {
        return {
            testName: $('#testName').val(),
            cost: $('#testCost').val()
        }
    }
    function showModal() {
        jQuery('#testModal').modal('show');
    }
    function addNewTest() {
        var url = 'clinical_test_endpoint.php';
        var data = getModalData();
        jQuery.ajax(
            {
                type: 'POST',
                url: url,
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function (response) {

                    console.log(response.statusCode);

                    if (response['statusCode'] == 200) {
                        console.log(response);
                        jQuery('#feedbackMessage').removeClass('alert alert-danger')
                            .addClass('alert alert-success')
                            .text(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }
                    else if (response.statusCode == 500) {
                        jQuery('#feedbackMessage').removeClass('alert alert-success')
                            .html('<div class="alert alert-danger alert-dismissable">' +
                                '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Error! </strong> ' + response.message + '</div>');
                    }
                }

            }
        )
    }

    function updateTest(id, testName, cost) {
        jQuery('#testModal').modal('show');
        $('#btn-add').text('Save changes');
        jQuery('#addTestTitle').text('Update Clinical Test');
        jQuery('#testName').val(testName);
        jQuery('#testCost').val(cost);

        jQuery('#btn-add').on('click', function (e) {
            e.preventDefault;
            var url = 'clinical_test_endpoint.php';
            var data = getModalData();
            data['id'] = id;
            jQuery.ajax(
                {
                    type: 'PUT',
                    url: url,
                    data: JSON.stringify(data),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        if (response.statusCode == 201) {
                            console.log(response);
                            jQuery('#feedbackMessage').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        }
                        else if (response.statusCode == 500) {
                            jQuery('#feedbackMessage').removeClass('alert alert-success')
                                .html('<div class="alert alert-danger alert-dismissable">' +
                                    '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Error! </strong> ' + response.message + '</div>');
                        }
                    }
                }
            )
        })

    }


    function deleteTest(id) {
        jQuery('#confirmDeleteModal').modal('show');
        var url = 'clinical_test_endpoint.php';
        jQuery('#btnConfirmDelete').on('click', function (e) {
            e.preventDefault();

            jQuery.ajax(
                {
                    type: 'DELETE',
                    url: url,
                    data: JSON.stringify({'id': id}),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8;',
                    success: function (response) {
                        if (response.statusCode == 204) {
                            console.log(response);
                            $('#confirmFeedback').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1200)
                        }
                        else if (response.statusCode == 500) {
                            $('#confirmFeedback').removeClass('alert alert-success')
                                .html('<div class="alert alert-danger alert-dismissable">' +
                                    '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Error! </strong> ' + response.message + '</div>');
                        }
                    }


                }
            )
        });
    }
</script>
</body>
</html>

