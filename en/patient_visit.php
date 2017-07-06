<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/9/17
 * Time: 7:46 AM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>Add Patient To Doctors Visit List</title>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="row">

            <div class="col col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="row">
                        <div class="col col-md-10">
                            <div class="search-form-contaner container-fluid">
                                <fieldset>
                                    <legend>Search Patient</legend>
                                    <form class="form-group">
                                        <label for="search">PatientFinder</label>
                                        <input type="text" class="form-control"
                                               placeholder="Search Patient by name, patient number, location, id number or phone number..."
                                               style="height: 45px;border: #1dcaff; border-style:solid; font-size: 16px;"
                                               id="searchText">
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div id="results">
                        <div class=" table-responsive container-fluid">
                            <table class="table table-striped">
                                <thead>
                                <tr class="bg-primary">
                                    <th>Patient Number</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Age</th>
                                    <th style="margin-left: 50px;">Action</th>
                                </tr>
                                </thead>
                                <tbody id="resultsTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4 (Confirm)-->
<div class="modal fade" id="confirm-addVisit" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Confirm Action</h4>
                <div id="confirmFeedback">

                </div>
            </div>

            <div class="modal-body">
                <p style="font-size: 16px;"> Click Continue to add the patient to visit list.</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btn-confirmAdd' class="btn btn-info">Continue</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
        $('#results').hide();
        search()
    });
</script>
<script>
    function search() {
        $('#searchText').on('keyup', function (e) {
            e.preventDefault;
            var text = $(this).val();
            var url = 'new_patient_visit_endpoint.php?q=' + text;
            $.ajax(
                {
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8;',
                    success: function (response) {
                        //console.log(response);
                        if (response.statusCode == 200) {
                            var data = response['data'];
                            var row = '';
                            for (var i = 0; i < data.length; i++) {
                                row += '<tr>' +
                                    '<td>' + data[i]['patientNo'] + '</td>' +
                                    '<td>' + data[i]['surName'] + '</td>' +
                                    '<td>' + data[i]['location'] + '</td>' +
                                    '<td>' + data[i]['age'] + '</td>' +
                                    '<td><button class="btn btn-primary btn-blue pull-right" onclick="addToVisitList(' + data[i]['id'] + ')">Add To VisitList</button></td>' +
                                    '</tr>';
                            }

                            $('#results').show();
                            $('#resultsTable').html(row);
                        } else {
                            $('#results').hide();
                        }


                    },
                    error: function (e) {
                        console.log("error", e);
                    }
                }
            )
        })
    }

    function addToVisitList(id) {
        $('#confirm-addVisit').modal('show');
        $('#btn-confirmAdd').on('click', function () {
            var url = 'patient_visit_endpoint.php';
            $.ajax(
                {
                    type: 'POST',
                    url: url,
                    data: JSON.stringify({'id': id}),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        if (response.statusCode == 200) {
                            console.log(response);
                            $('#confirmFeedback').removeClass('alert alert-danger')
                                .addClass('alert alert-success')
                                .text(response.message);
                            setTimeout(function () {
                                location.reload();
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
