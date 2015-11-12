<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
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

?>
            <h2>Bienvenue sur notre site de Pointage</h2>
            Ce site a été créé par <ul><li>Adam Belqasmi</li><li>Kévin Wandolski</li><li>Natoli Anthony</li></ul>
            Les fonctions qui le compose sont les suivantes :
            <ul>
                <li>Possibilité d'inscription</li>
                <li>Connexion avec des identifiants enregistrés dans la BDD</li>
                <li>Possibilité de Pointage/Dépointage grâce à des méthodes de classes</li>
            </ul>
            Infos :
            <ul>
                <li>Utilisation de Bootstrap</li>
                <li>Utilisation des variables session</li>
                <li>Utilisation des requêtes SQL : SELECT, INSERT INTO, UPDATE</li>
                <li>Utilisation de méthodes de classes reliées à la BDD</li>
            </ul>
            <br><br><br>
            TODO :
            <ul>
                <li>Panneau Administrateur :</li>
                <ul>
                    <li><s>Liste des pointages</s> (05/10)</li>
                    <li>Pagination de la liste</li>
                    <li><s>Débadger chaque pointage</s> (06/10)</li>
                    <li><s>Sauf si les secondes cumulées sont négatives</s> (06/10)</li>
                </ul>
                <li>Choix de l'heure du Pointage (formulaire pour chaque fonction)</li>
                <li><s>Footer</s> (29/09)</li>
                <li><s>Finir l'aside left (dernier pointage, total des pointages, total des secondes pointées)</s> (29/09)</li>
                <li>Finir fonction débadger (tout débadger à X heures ou à la main)</li>
            </ul>
        </div>
    </div>
</div>
<?php include '../Parts/footer.php';?>
</body>
</html>