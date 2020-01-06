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
                    <h1>Περίοδος Λειτουργίας!</h1>
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
                <h2 class="section-heading">Σημαντικό! Περίοδος Λειτουργίας</h2>
                <p>Το Εστιατόριο θεωρήται ανοιχτό σε ωράριο που καθορίζεται απο τη φόρμα δίπλα που λέει "Ωράριο"</p>
                <p>Το Εστιατόριο θεωρήται ανοιχτό κάθε μέρα για όλα τα έτη πλην απο τις ημερομηνίες διακοπών που καθορίζονται στη φόρμα δίπλα με τίτλο "Διακοπές"</p>
                <p>&nbsp;</p><p>&nbsp;</p>
                <h2>Ωράριο</h2>
                <p>
                    <?php
                    $database = new CORE\Database();
                    $timetable = $database->findAll("select config_key, description, config_values from config where config_key in ('starttime','endtime') order by config_key desc");

                    foreach($timetable as $timetablerow) {
                        if ($timetablerow['config_key'] == 'starttime') {
                            echo '<h3>Έναρξη: ' . $timetablerow['config_values'] . '</h3>';
                        } else {
                            echo '<h3>Λήξη: ' . $timetablerow['config_values'] . '</h3>';
                        }
                    }

                    ?>

                </p>
<p>&nbsp;</p><p>&nbsp;</p>
                <h2>Χρόνος Κράτησης Τραπεζιού</h2>
                <p>
                    <?php
                    $database = new CORE\Database();
                    $timetable = $database->findAll("select config_key, description, config_values from config where config_key = 'reshrs'");

                    foreach($timetable as $timetablerow) {

                            echo '<h3>Ώρες: ' . $timetablerow['config_values'] . '</h3>';

                    }

                    ?>

                </p>
                <p>&nbsp;</p><p>&nbsp;</p>
                <h2>Διακοπές</h2>
                <p>
                    <?php
                    $database = new CORE\Database();
                    $timetable = $database->findAll("select hid,h_start,h_finish from holidays order by h_start");

                    foreach($timetable as $timetablerow) {

                            echo '<h4>'.$timetablerow['h_start'].' εως ' . $timetablerow['h_finish'] . '&nbsp;&nbsp;-&nbsp;&nbsp;<a href="../api/service/HolydayPlanService.php?hid='. $timetablerow['hid'].'">Διαγραφή</a></α></h4>';

                    }

                    ?>

                </p>

            </div>
            <div class="col-lg-5 col-sm-6">

                <form class="form-horizontal" id="reg-form" action="../api/service/TimePlanService.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Ωράριο</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="starttime">Έναρξη</label>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input type='text' name="starttime" class="form-control" autocomplete="off" />
                                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker3').datetimepicker({
                                        format: 'HH:mm'
                                    });
                                });
                            </script>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="endtime">Λήξη</label>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker4'>
                                        <input type='text' name="endtime" class="form-control" autocomplete="off" />
                                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker4').datetimepicker({
                                        format: 'HH:mm'
                                    });
                                });
                            </script>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Αλλαγή</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

                <form class="form-horizontal" id="reg-form" action="../api/service/ReserveTimePeriod.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Χρόνος Κράτησης Τραπεζιού</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="starttime">Ώρες</label>
                            <div class='col-sm-6'>
                                <div class="form-group">

                                        <input type='number' name="reshrs" class="form-control" autocomplete="off" />

                                </div>
                            </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Αλλαγή</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

                <form class="form-horizontal" id="reg-form" action="../api/service/HolydayPlanService.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Διακοπές</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="container">
                                <div class='col-md-2'><label class="col-md-4 control-label" for="vacstart">Έναρξη</label><br /><br /><br />
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text' name="vacstart" class="form-control" autocomplete="off" />
                                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-2'><label class="col-md-4 control-label" for="vacend">Λήξη</label><br /><br /><br />
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker7'>
                                            <input type='text' name="vacend" class="form-control" autocomplete="off" />
                                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker6').datetimepicker( {format: 'YYYY-MM-DD'});
                                    $('#datetimepicker7').datetimepicker({
                                        format: 'YYYY-MM-DD',
                                        useCurrent: false //Important! See issue #1075
                                    });
                                    $("#datetimepicker6").on("dp.change", function (e) {
                                        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                                    });
                                    $("#datetimepicker7").on("dp.change", function (e) {
                                        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                                    });
                                });
                            </script>
                        </div>


                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Αλλαγή</button>
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


<script>
    $('#passwordinput, #passwordinput2').on('keyup', function () {
        if ($('#passwordinput').val() == $('#passwordinput2').val()) {
            $('#message').html('').css('color', 'green');
            $('#signupbtn').prop('disabled', false);
        } else {
            $('#message').html('Οι Κωδικοί δεν ταιριάζουν!').css('color', 'red');
            $('#signupbtn').prop('disabled', true);
        }
    });



</script>

</body>

</html>
