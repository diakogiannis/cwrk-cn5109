<?php require ('includes/session.php');?><!DOCTYPE html>
<html lang="en">

<head>

      <title>Alexius Restaurant</title>

    <?php require_once ('includes/header.php');?>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Πιέστε για το Μενού Επιλογών</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#about">Κάντε Κράτηση</a>
                </li>
                <li>
                    <a href="#services">Είσοδος</a>
                </li>
                <li>
                    <a href="#contact">Εγγραφή</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>



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
                <h2 class="section-heading">Το ιδιάιτερο εστιατόριο που απλά... ΔΕΝ ΥΠΑΡΧΕΙ!</h2>
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
