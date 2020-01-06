<?php require ('includes/session.php');?><!DOCTYPE html>
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
            <div class="col-lg-5 col-lg-offset-2 col-sm-6"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <img class="img-responsive" src="img/signup.png" alt="">
            </div>
            <div class="col-lg-5 col-sm-6">

                <form class="form-horizontal" id="reg-form" action="../api/service/RegistrationService.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Εγγραφή Χρήστη</legend>
                        <?php

                        if(isset($_GET["error"])) {
                            $error = addslashes($_GET["error"]);
                            switch ($error) {
                                case 'userexists':
                                    ?>
                        <div class="alert alert-danger" role="alert">Ο Χρήστης Υπάρχει!</div>
                                    <?php
                                    break;
                                case 'fieldsmissing':
                                    ?>
                                    <div class="alert alert-danger" role="alert">Παρακαλώ Συμπληρώστε ΟΛΑ τα πεδια</div>
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
                                <input id="email" name="email" type="text" placeholder="a@b.com" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fname">Όνομα</label>
                            <div class="col-md-4">
                                <input id="fname" name="fname" type="text" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="lname">Επώνυμο</label>
                            <div class="col-md-4">
                                <input id="lname" name="lname" type="text" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Διεύθηνση</label>
                            <div class="col-md-4">
                                <input id="address" name="address" type="text" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone">Τηλέφωνο</label>
                            <div class="col-md-4">
                                <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="city">Πόλη</label>
                            <div class="col-md-4">
                                <input id="city" name="city" type="text" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="passwordinput">Κωδικός Πρόσβασης</label>
                            <div class="col-md-4">
                                <input id="passwordinput" name="passwordinput" type="password" placeholder="" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="passwordinput2">Επιβ. Κωδικού Πρόσβασης</label>
                            <div class="col-md-4">
                                <input id="passwordinput2" name="passwordinput2" type="password" placeholder="" class="form-control input-md" required="">
                                <span id='message'></span>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Εγγραφή!</button>
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

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

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
