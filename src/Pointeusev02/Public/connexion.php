<?php session_start();?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link href="../Ressources/bootstrap-3.3.2-dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../Ressources/page.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <?php include '../Parts/left.php';?>
            <div class="col-md-8 col-md-offset-2" id="body">
<?php
include '../Parts/header.php';
echo '<div style="margin-top:70px;"></div>';
include '../Parts/nav.php';
echo '<div class="row" id="content">';

if(isset($_SESSION['err_co'])){
    echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    '.$_SESSION["err_co"].'
    </div>';
    unset($_SESSION['err_co']);
}

if(!isset($_SESSION['site'])) {
    echo '<div class="row"><div class="col-md-offset-3 col-md-6" id="form_ins">';
    echo '<form method="post" action="../Scripts/authentificationsite.php">';
    echo '<label>Identifiant : <input type="text" name="id"></label>';
    echo '<label>Mot de passe : <input type="password" name="mdp"></label><br><br>';
    echo '<button class="btn btn-success" type="submit">Envoyer <span class="glyphicon glyphicon-ok"></span></button></form>';
    echo '</div></div>';
}else{
    echo '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    Vous êtes bien connecté en tant que <b>'.$_SESSION["pseudo"].'</b>
    </div>';
}
?>
            </div>
        </div>
    </div>
    <?php include '../Parts/footer.php';?>
    </body>
</html>