<?php require ('includes/session.php');
function url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}
$_SESSION['url'] =str_replace(basename(url()),"",url());

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Alexius Restaurant</title>

    <?php require_once ('includes/header.php');?>


</head>

<body>
<?php require_once("includes/menu.php"); ?>


<!-- Header -->
<a name="about"></a>
<div class="intro-header">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>My Awesome Restaurant!</h1>
                    <h3>Book now for an AMC Experience</h3>
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
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Το ιδιαίτερο εστιατόριο που απλά... ΔΕΝ ΥΠΑΡΧΕΙ!</h2>
                <h3><div class="bg-primary">Για Κράτηση πρέπει να Συνδεθείτε ή να κάνετε Εγγραφή!</div></h3>

                <p class="lead">Το πρώτο εστιατόριο ΔΕΝ ΥΠΑΡΧΕΙ, που άνοιξε στην Ελλάδα το Δεκέμβριο του 2018 και άνοιξε το δρόμο
                    της ανύπαρκτης επιτυχίας. Βρίσκεται στην καρδιά του σέρβερ του Μητροπολιτικού Κολλεγίου.
                    Αποτελεί σταθερή αξία και αγαπημένη συνήθεια. Ξεχωρίζει για τη μοναδική ανύπαρκτη αυλή του και τον privé χώρο
                    που διαθέτει για ανύπαρκτες εκδηλώσεις.</p>
                <p class="lead">
                    Το εστιατόριο υποδέχεται τους επισκέπτες του με ένα ατμοσφαιρικό cocktail bar που βρίσκεται μόνο στη φαντασία
                    τους και συνδέει δύο κομψές σάλες εποχής, ενώ πλαισιώνεται από τον γνωστό υπέροχο κήπο της ΕΔΕΜ.
                </p>
                <p class="lead">Υπεύθυνος για το μενού είναι ο βραβευμένος (και συγχωρεμένος) Chef Τσελεμεντές, προσφέρει το δικό
                    του -out of this world- γαστρονομικό αποτύπωμα.
                    Χαρακτηρίζεται από την ιδιαίτερα ηχηρή, "Αγγελικού Σαλπισματος", μαγειρική του φιλοσοφία.
                </p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="img/happy-little-chef.jpg" alt="">
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

</body>

</html>
