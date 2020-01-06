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
                    <h1>Τραπέζια!</h1>
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
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <!-- h2 class="section-heading">Σημαντικό! Περίοδος Λειτουργίας</h2>
                <p>Το Εστιατόριο θεωρήται ανοιχτό σε ωράριο που καθορίζεται απο τη φόρμα δίπλα που λέει "Ωράριο"</p>
                <p>Το Εστιατόριο θεωρήται ανοιχτό κάθε μέρα για όλα τα έτη πλην απο τις ημερομηνίες διακοπών που καθορίζονται στη φόρμα δίπλα με τίτλο "Διακοπές"</p -->

                <h2>Τραπέζια</h2>
                <p>
                    <table  class="table">
                    <tr>
                        <th scope="col">Νούμερο</th>
                        <th scope="col">Θέσεις</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                    <?php
                    $database = new CORE\Database();
                    $tables = $database->findAll("select table_number tn, seats from tables;");

                    foreach($tables as $table) {
                            echo '<tr><th scope="row">'.$table['tn'].'</th><td>'.$table['seats'].'</td><td><a href="../api/service/TableService.php?tn='.$table['tn'].'"   class="btn btn-large btn-primary" data-toggle="confirmation" onclick="return confirm(\'ΑΥΤΗ Η ΕΝΕΡΓΕΙΑ ΘΑ ΔΙΑΓΡΑΨΕΙ ΚΑΙ ΟΛΕΣ ΤΙΣ ΚΡΑΤΗΣΕΙΣ ΠΟΥ ΣΥΝΔΕΟΝΤΑΙ ΜΕ ΑΥΤΟ ΤΟ ΤΡΑΠΕΖΙ('.$table['tn'].')! ΕΙΣΑΙ ΣΙΓΟΥΡΟΣ?\')"  >Διαγραφή</a></td></tr>';
                    }

                    ?>
                </table>
                </p>



            </div>
            <div class="col-lg-5 col-sm-6">
                <p>&nbsp;</p><p>&nbsp;</p>
                <form class="form-horizontal" id="reg-form" action="../api/service/TableService.php" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Προσθήκη Τραπεζιού</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="seats">Θέσεις</label>
                            <div class="col-md-4">
                                <input id="seats" name="seats" type="number" class="form-control input-md" required="">

                            </div>
                        </div>


                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signupbtn"></label>
                            <div class="col-md-4">
                                <button id="signupbtn" name="signupbtn" class="btn btn-primary">Εισαγωγή</button>
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
    $(':checkbox').checkboxpicker();




</script>

</body>

</html>
