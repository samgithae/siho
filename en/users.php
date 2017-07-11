<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/21/17
 * Time: 9:51 AM
 */
require_once __DIR__.'/../vendor/autoload.php';
$counter = 1;
$users = \Hudutech\Controller\UserController::all();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="row">

            <div class="col col-md-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="container-fluid" style="margin-top: 15px;">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $counter++ ?></td>
                                        <td><?php echo $user['firstName'];?></td>
                                        <td><?php echo $user['lastName'];?></td>
                                        <td><?php echo $user['email'];?></td>
                                        <td><?php echo $user['username'];?></td>
                                        <td><?php echo $user['userLevel'];?></td>
                                        <td>
                                            <a href="change_password.php?username=<?php echo urlencode($user['username'])?>" class="btn btn-default"><i class="entypo-lock-open"></i>Change Password</a>
                                            <?php
                                            if ($user['isActive'] == 1){
                                                ?>
                                            <button class="btn btn-info" onclick="showConfirmModal('<?php echo $user['id']?>', '<?php echo $user['username']?>')"><i class="entypo-lock"></i> Deactivate Account</button>
                                           <?php
                                            } elseif($user['isActive'] == 0){
                                                ?>
                                            <button class="btn btn-success" onclick="showConfirmModal('<?php echo $user['id']?>', '<?php echo $user['username']?>')"><i class="entypo-lock"></i> Activate Account</button>
                                           <?php
                                            }
                                            ?>

                                            <button class="btn btn-danger btn-red">Delete Account</button>
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

<!--Confirm Action modal-->

<div class="modal fade" id="confirmDeactivate" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="confirmTitle">Confirm Action</h4>
                <div id="confirmFeedback">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="username" id="username">

                </div>
            </div>

            <div class="modal-body">
                <p style="font-size: 16px;" id="info"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnConfirmDeactivate' onclick="deactivate()" class="btn btn-info">Continue</button>
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

    });
</script>

<script>
    function showConfirmModal(id, username) {
       var loggedIn = '<?php echo $_SESSION['username']?>';
       if (username == loggedIn) {
           $('#confirmTitle').text("Deactivate account");
           $('#info').text(
               "Are You sure you want to deactivate this account?" +
               "This is the current Logged in account. Deleting this account will" +
               " automatically log you out. You will not be able to login again."
           ).addClass("alert alert-info");
       } else{
           $('#info').text(
               "Are you sure you want to deactivate this account? deactivating the account" +
               " will make the user not to access the account until the account is activated again "
           ).addClass("alert alert-info");
       }
       $('#id').val(id);
       $('#username').val(username);
       $('#confirmDeactivate').modal('show');


    }

    function deactivate() {
        var url  = 'deactivate_account.php';
        var id = $('#id').val();
        var username = $('#username').val();
        var data = {id:id, username:username};
        console.log(data);
        $.ajax(
            {
                type: 'POST',
                url : url,
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function (response) {
                    if (response.statusCode == 200) {
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

    }
</script>

</body>
</html>
