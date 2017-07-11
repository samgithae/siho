<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/12/17
 * Time: 11:00 AM
 */

require_once __DIR__ . '/../vendor/autoload.php';


?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>Delete Prescription</title>
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
        <div class="panel panel-primary" data-collapsed="0">
            <div class="col col-md-6" style="margin:20px;">
                <button class="btn btn-danger btn-red" onclick="deletePresc('<?php echo $_GET['id']?>')">Click to Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4 (Confirm)-->
<div class="modal fade" id="Confirm">
    <!--<div class="modal fade" id="Confirm" data-backdrop="static">-->
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Confirm Action</h4>
                <div id="confirmFeedback">

                </div>
            </div>

            <div class="modal-body">
                <p style="font-size: 16px;"> Are you sure you want to delete?.</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnConfirm' class="btn btn-info">Continue</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer_views.php' ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>

<script>

    function deletePresc(id) {
        $('#Confirm').modal('show');
        $('#btnConfirm').on('click', function () {

            var url = 'recommend_drug_endpoint.php';
            $.ajax(
                {
                    type: 'DELETE',
                    url: url,
                    data: JSON.stringify({id: id}),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8;',
                    success: function (response) {
                        if (response.statusCode == 204) {
                            console.log(response);
                            $('#confirmFeedback').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                location.href = 'recommend_drug.php';
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
        })

    }
</script>
</body>
</html>

