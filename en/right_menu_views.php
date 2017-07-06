<?php
session_start();
require_once '../vendor/autoload.php';
$username = '';
$level = '';
if (!isset($_SESSION['username'])){
    header('Location: login.php');
}
if (isset($_SESSION['username'])) {
    $user = \Hudutech\Controller\UserController::getLoggedInUser($_SESSION['username']);
    $username = $user['username'];
    $level = $user['userLevel'];
}
?>
<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="../index.php">
                    <img src="../public/assets/images/clinic.png" width="120" alt=""/>
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon">
                    <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>

        <div class="sidebar-user-info">

            <div class="sui-normal">
                <div class="user-link" >

                    <i style="color: white; font-size: 3em; display: inline-block;width: 100%;text-align: center;"
                       class="fa fa-user-md "></i>

                    <h2 style="font-size: 1.5em; color: white; text-align: center;">Welcome,<?php echo $username ?></h2>
                    <p style="font-size: 1.2em; color: white; text-align: center;"> Logged in as (<?php echo $level; ?>
                        )</p>
                </div>
            </div>


        </div>

        <?php
        if ($level=='admin')
        {
            admin();
        }
        else if($level=='receptionist')
        {
            receptionist();
        }
        else if($level=='doctor')
        {
            doctor();
        }
        else if($level=='lab_technician')
        {
            lab_technician();
        }
        else if($level=='pharmacist')
        {
            pharmacist();
        }


        ?>
        <?php function admin(){?>

            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="opened active has-sub multiple-expanded">
                    <a href="#">
                        <i class="fa fa-plus-square" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 1.8em;">Registration</span>
                    </a>
                    <ul class="visible">
                        <li>
                            <a href="register_user.php">
                                <i class="fa fa-user-plus" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Register User</span>
                            </a>
                        </li>
                        <li>
                            <a href="register_patient.php">
                                <i class="fa fa-user-md" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Register Patient</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_drug.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Drug</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_product.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Product</span>
                            </a>
                        </li>

                        <li>
                            <a href="patients.php">
                                <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">View Patients</span>
                            </a>
                        </li>

                        <li>
                            <a href="users.php">
                                <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">View Users</span>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="has-sub">
                <a href="patient_visit.php">
                    <i class="fa fa-wheelchair" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Patient Visit</span>
                </a>

                </li>

                <li class="has-sub">

                    <a href="consultation.php">
                        <i class="fa fa-stethoscope" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Consultation</span>
                    </a>

                </li>


                <li class="has-sub">

                    <a href="#">
                        <i class="fa fa-medkit" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Lab Test</span>
                    </a>

                    <ul >
                        <li>
                            <a href="perform_tests.php">
                                <i class="fa fa-search" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Perform Test</span>
                            </a>
                        </li>
                        <li>
                            <a href="test_results.php">
                                <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">View Lab Test</span>
                            </a>
                        </li>
                        <li>
                            <a href="clinical_tests.php">
                                <i class="fa fa-medkit" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Add Clinical Test</span>
                            </a>
                        </li>


                    </ul>

                </li>
                <li class="has-sub">
                    <a href="pos.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Pharmacy</span>
                    </a>

                </li>

            </ul>
        <?php }?>
        <?php function receptionist(){?>

            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="opened active has-sub multiple-expanded">
                    <a href="#">
                        <i class="fa fa-plus-square" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 1.8em;">Registration</span>
                    </a>
                    <ul class="visible">
                        <li>
                            <a href="register_user.php">
                                <i class="fa fa-user-plus" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Register User</span>
                            </a>
                        </li>
                        <li>
                            <a href="register_patient.php">
                                <i class="fa fa-user-md" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Register Patient</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_drug.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Drug</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_product.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Product</span>
                            </a>
                        </li>

                        <li>
                            <a href="patients.php">
                                <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">View Patients</span>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="has-sub">
                <a href="patient_visit.php">
                    <i class="fa fa-wheelchair" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Patient Visit</span>
                </a>

                </li>




            </ul>
        <?php }?>
        <?php function doctor(){?>

            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


                <li class="has-sub">

                    <a href="consultation.php">
                        <i class="fa fa-stethoscope" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Consultation</span>
                    </a>

                </li>


                <li class="has-sub">

                    <a href="test_results.php">
                        <i class="fa fa-medkit" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> View Lab Test</span>
                    </a>



                </li>
                <li class="has-sub ">
                    <a href="#">
                        <i class="fa fa-plus-square" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 1.8em;">Pharmacy</span>
                    </a>
                    <ul class="visible">
                        <li class="has-sub">
                            <a href="pos.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 1.8em;"></i>
                                <span class="title" style="font-size: 2em;"> POS</span>
                            </a>

                        </li>

                        <li>
                            <a href="record_drug.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Drug Inventory</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_product.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Product Inventory</span>
                            </a>
                        </li>



                    </ul>
                </li>
                <li class="has-sub">

                    <a href="drug_sales.php">
                        <i class="fa fa-money" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Drug Sales</span>
                    </a>

                </li>
            </ul>
        <?php }?>
        <?php function lab_technician(){?>

            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->





                <li class="opened active has-sub multiple-expanded">

                    <a href="#">
                        <i class="fa fa-medkit" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 2em;"> Lab Test</span>
                    </a>

                    <ul >
                        <li>
                            <a href="perform_tests.php">
                                <i class="fa fa-search" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Perform Test</span>
                            </a>
                        </li>
                        <li>
                            <a href="test_results.php">
                                <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">View Lab Test</span>
                            </a>
                        </li>
                        <li>
                            <a href="clinical_tests.php">
                                <i class="fa fa-medkit" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Add Clinical Test</span>
                            </a>
                        </li>


                    </ul>

                </li>


            </ul>
        <?php }?>
        <?php function pharmacist(){?>

            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="opened active has-sub multiple-expanded">
                    <a href="#">
                        <i class="fa fa-plus-square" style="font-size: 1.8em;"></i>
                        <span class="title" style="font-size: 1.8em;">Pharmacy</span>
                    </a>
                    <ul class="visible">
                        <li class="has-sub">
                            <a href="pos.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 1.8em;"></i>
                                <span class="title" style="font-size: 2em;"> POS</span>
                            </a>

                        </li>

                        <li>
                            <a href="record_drug.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Drug</span>
                            </a>
                        </li>
                        <li>
                            <a href="record_product.php">
                                <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                                <span class="title" style="font-size: 1.5em;">Record Product</span>
                            </a>
                        </li>



                    </ul>
                </li>








            </ul>
        <?php }?>

    </div>
</div>