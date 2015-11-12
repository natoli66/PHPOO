<div class="row">
    <div class="col-md-offset-2 col-md-8" id="nav">
        <nav role="navigation" class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">Pointeuse V02</a>
            </div>
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../Public/index.php">Accueil</a></li>
                    <?php
                    if(!isset($_SESSION['site'])){
                        echo "</ul>
                            <ul class='nav navbar-nav navbar-right'>
                            <li><a href='../Public/connexion.php'><span class='glyphicon glyphicon-log-in'></span> Connexion</a></li>
                            <li><a href='../Public/inscription.php'><span class='glyphicon glyphicon-user'></span> S'inscrire</a></li>
                            </ul>";
                    }else{
                        echo "<li><a href='../Public/pointage.php'>Pointage</a></li></ul>
                        <ul class='nav navbar-nav navbar-right'>
                        <li><a href='../Scripts/deconnexion.php'><span class='glyphicon glyphicon-log-out'></span> Déconnexion</a></li></ul>";
                    }
                    ?>

            </div>
        </nav>
    </div>
</div>