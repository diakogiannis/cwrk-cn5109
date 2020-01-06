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
                    <h1>LOGIN!</h1>
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
                <img class="img-responsive" src="img/login.png" alt="">
            </div>
            <div class="col-lg-5 col-sm-6"><h1>Είσοδος</h1>
                <?php

                function generateRandomString($length = 10) {
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                if(!empty($_GET["error"])) {
                    $error = addslashes($_GET["error"]);
                }
                if(!empty($error)) {
                    switch ($error) {
                        case 'loginerror':
                            ?>
                            <div class="alert alert-danger" role="alert">Λάθος στοιχεία εισόδου! επειδή χρησημοποιήσατε
                                τον
                                κωδικό του
                                χρήστη <?php echo generateRandomString() . '@' . generateRandomString(6) . '.' . generateRandomString(3); ?>
                                μήπως είστε εκείνος?
                            </div>
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

                <form action="../api/service/LoginService.php?action=login" method="post">
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Password" name="passwordinput" required="required">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
                    </div>
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
