<?php require('includes/session.php');
require ('auth.php');


use com\diakogiannis\phpresteasy\api\core as CORE;
use com\diakogiannis\phpresteasy\api\repositories as REPOS;
/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:58
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */
require_once __DIR__.'/../Constants.php';

require_once (ROOT_PATH.'/api/core/Database.php');
require_once (ROOT_PATH.'/api/core/Properties.php');

?><!DOCTYPE html>
<html lang="en">

<head>


    <title>Alexius Restaurant</title>

    <?php require_once('includes/header.php');?>

</head>

<body>
<?php require_once("includes/menu.php"); ?>

<!-- Header -->
<a name="about"></a>
<div class="intro-header">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="intro-message">
                    <h1>Εγγραφή!</h1>
                    <hr class="intro-divider">
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<a  name="services"></a>
<div class="content-section-a">

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-2 col-sm-6"><p>&nbsp;</p>
                <img class="img-responsive" src="img/reservation-img.jpg" alt="">
            </div>
            <div class="col-lg-5 col-sm-6">

                <?php
                    $database = new CORE\Database();
                    $parameters = array("email" => $_SESSION{'login_user'});
                    $users = $database->findAll("
                            select 
                                u.email as email, 
                                fname, 
                                lname, 
                                address, 
                                city, 
                                 
                                ucd.type as type, 
                                ucd.value as value 
                            from users u 
                                left join 
                                    user_contact_details ucd 
                                        on u.email = ucd.email
                                        where u.email = :email",$parameters);

                foreach($users as $user) {
                    $email = $user['email'];
                    $fname = $user['fname'];
                    $lname= $user['lname'];
                    $address = $user['address'];
                    $city = $user['city'];
                    $phone = '';
                    if($user['type'] == 'PHONE'){
                    $phone = $user['value'];
                    }

                }


                ?>
                notworking

                <form class="form-horizontal" id="reg-form" action="../api/service/BookService.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Αίτημα Κράτησης</legend>
                        <?php

                        if(isset($_GET["error"])) {
                            $error = addslashes($_GET["error"]);
                            switch ($error) {
                                case 'notable':
                                    ?>
                        <div class="alert alert-danger" role="alert">Δεν υπάρχει διαθέσιμο τράπεζι!</div>
                                    <?php
                                    break;
                                case 'fieldsmissing':
                                    ?>
                                    <div class="alert alert-danger" role="alert">Παρακαλώ Συμπληρώστε ΟΛΑ τα πεδια</div>
                                    <?php
                                    break;
                                case 'notworking':
                                    ?>
                                    <div class="alert alert-danger" role="alert">Καλό θα ήταν να έρθετε όταν λειτουργεί το εστιατόριο :) </div>
                                    <?php
                                    break;
                                case 'allok':
                                    ?>
                                    <div class="alert alert-success" role="alert">Επιτυχής Κράτηση!</div>
                                    <?php
                                    break;


                                default:
                                    ?>
                                    <div class="alert alert-danger" role="alert">Άγνωστο Σφάλμα!</div>
                                    <?php
                                    break;
                            }
                        }

                        ?>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">email</label>
                            <div class="col-md-4">
                                <input id="email" name="email" type="text" value="<?= $email ?>" class="form-control input-md" readonly required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fname">Όνομα</label>
                            <div class="col-md-4">
                                <input id="fname" name="fname" type="text" value="<?= $fname ?>" class="form-control input-md" <?= $_SESSION['role']=='ADMIN'?'':"readonly" ?> required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="lname">Επώνυμο</label>
                            <div class="col-md-4">
                                <input id="lname" name="lname" type="text" value="<?= $lname ?>" class="form-control input-md" <?= $_SESSION['role']=='ADMIN'?'':"readonly" ?> required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Διεύθηνση</label>
                            <div class="col-md-4">
                                <input id="address" name="address" type="text" value="<?= $address ?>" class="form-control input-md" <?= $_SESSION['role']=='ADMIN'?'':"readonly" ?> required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone">Τηλέφωνο</label>
                            <div class="col-md-4">
                                <input id="phone" name="phone" type="text" value="<?= $phone ?>" class="form-control input-md"  required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="city">Πόλη</label>
                            <div class="col-md-4">
                                <input id="city" name="city" type="text" value="<?= $city ?>" class="form-control input-md" <?= $_SESSION['role']=='ADMIN'?'':"readonly" ?> required="">

                            </div>
                        </div>





                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="city">Ημερομηνία/Ώρα</label>
                                        <div class='input-group date' id='datetimepicker3'>
                                            <input type='text' name="resdatetime" class="form-control input-sm" autocomplete="off" required="" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker3').datetimepicker({
                                    format: 'YYYY-MM-DD HH:mm',
                                    minDate: new Date()
                                });
                            });
                        </script>


                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="city">Άτομα</label>
                            <div class="col-md-4">
                                <input id="persons" name="persons" type="number"  class="form-control input-sm" required="">

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Κράτηση!</button>
                            </div>
                        </div>

                    </fieldset>
                </form>


            </div>


        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->


<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li>
                        <a href="#">A Univercity project of Alexius Diakogiannis</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>



</body>

</html>
