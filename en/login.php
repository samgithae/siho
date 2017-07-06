<?php
session_start();
error_reporting(0);
require_once __DIR__.'/../vendor/autoload.php';
include __DIR__.'/includes/login.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Heal | Login</title>
    <?php include 'head_views.php'; ?>
<style>
    .avator{
        width: 600px;

        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 2%;
        -webkit-border-radius: 2%;
        border-radius: 2%;
    }
    .diva {
        display:inline-block;
        color:#444;
        border:1px solid #CCC;
        background:#DDD;
        box-shadow: 0 0 5px -1px rgba(0,0,0,0.2);
        cursor:pointer;
        vertical-align:middle;
        width: 300px;

        padding: 5px;
        text-align: center;
    }
</style>
</head>
<body class="page-body login-page">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '';
</script>

<div class="login-container">

    <div class="login-header login-caret">
        <div class=" col-md-6 col-md-offset-3">

            <img src="../public/assets/images/hospitalhand.jpg" class="avator"alt=""/>


        </div>


    </div>


    <div class=" login-form " >

        <div class="login-content">

            <div>
                <?php
                if(empty($success_msg) && !empty($error_msg)){
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $error_msg ?>
                    </div>
                    <?php
                }
                elseif(empty($error_msg) and !empty($success_msg)){
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $success_msg  ?>
                    </div>

                    <?php
                }

                ?>
            </div>

            <p class="description" style="color: white; ">Dear user, log in to access the admin area!</p>
            <div class="form-login-error">
                <h3>Invalid login</h3>

            </div>


                <form class="diva" role="form" id="form_login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" METHOD="post">

                <div class="form-group ">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                               autocomplete="off"/>
                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                               autocomplete="off"/>
                    </div>

                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg btn-block login-button"/>


                </div>


            </form>


            <div class="login-bottom-links">

                <a href="#" class="link">Forgot your password?</a>

                <br/>



            </div>

        </div>

    </div>

</div>

<?php include 'footer_views.php'?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>

</body>
</html>