
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
                    <a href=".">Αρχική</a>
                </li>

                    <?php
                    if(isset($_SESSION['login_user'])){

                        echo('<li><a href="">'.$_SESSION['login_user'].'</a></li>');
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') {
                        echo('<li><a href="settings.php">Περίοδος Λειτ.</a></li>');
                        echo('<li><a href="tables.php">Τραπέζια</a></li>');
                        echo('<li><a href="reservations.php">Κρατήσεις</a></li>');

                    }else {
                        echo('<li><a href="reservations.php">Κρατήσεις</a></li>');
                    }
                    ?>
                        <li>
                            <a href="book.php">Κάντε Κράτηση</a>
                        </li>
                <li>
                        <a href="../api/service/LogoutService.php" >Αποσύνδεση</a>
                </li>
                    <?php
                    }else {
                        ?>
                        <li>
                            <a href="login.php">Είσοδος</a>
                        </li>
                        <li>
                            <a href="registration.php">Εγγραφή</a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


