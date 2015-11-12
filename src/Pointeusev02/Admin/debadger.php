<?php session_start();?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Débadger (admin)</title>
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

use PointeuseV02\PDOPointeuse;
use PointeuseV02\PointeuseV02;

$pdo = PDOPointeuse::getPdoPointeuse();
$Pointeuse = new PointeuseV02();

if(!isset($_SESSION['site'])){
    echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">AccessDenied(disconnected):</span>
    Vous devez être connecté en tant qu\'administrateur pour pouvoir accéder à cette page !
    </div>';
}else {
    $pseudo = $_SESSION['pseudo'];
    $req = $pdo->requeteSelection("select * from client where pseudo='$pseudo' ");

    if (!$req[0]['admin']) {
        echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">AccessDenied(notAdmin):</span>
    Seuls les administrateurs peuvent accéder à cette page !
    </div>';
    }else{
        if(!isset($_GET['id'])){
            echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">noID:</span>
    Vous devez spécifier un id de Pointage à débadger !
    </div>';
        }else{
            if(!is_numeric($_GET['id'])){
                echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">fakeID:</span>
    Vous devez spécifier un id de type entier !
    </div>';
            }else{
                $idP=intval($_GET['id']);
                $req = $pdo->requeteSelection("select * from Pointeuse,Client where idPointage=$idP AND client.idClient = pointeuse.idclient ");
                if(!$req){
                    echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">unavalaibleID:</span>
    Cet id de pointage n\'est pas contenu dans la base de données !
    </div>';
                }else{
                    if($req[0]["heureFin"]!=""){
                        if(isset($_POST)){
                            echo '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    <span class="sr-only">bienPointé:</span>
    Vous avez bien débadgé <b>'.$req[0]["pseudo"].'</b> à '.$req[0]["heureFin"].' lors du pointage n°'.$idP.' !
    </div>';
                        }else {
                            echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">dejaPointé:</span>
    Cet ID de pointage a déjà été débadgé !
    </div>';
                        }
                    }else {
                        if (isset($_POST['fin'])) {
                            if (isset($_POST['huitheures'])) {
                                $fin = date("G:i:s", (strtotime($req[0]["heureDébut"]) + 28800));
                            } else {
                                if ($_POST['fin'] == "") {
                                    $fin = "20:00:00";
                                } else {
                                    $fin = $_POST['fin'];
                                }
                            }
                            if ($Pointeuse->heuresCumulées("", $idP, $fin)["total"] < 0) {
                                echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">hfinInvalide:</span>
    Veuillez entrer une heure supérieure à l\'heure de début
    </div>';
                            } else {
                                $Pointeuse->debadger($req[0]["idClient"], $idP, $fin, 1);
                                echo '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    <span class="sr-only">bienPointé:</span>
    Vous avez bien débadgé <b>'.$req[0]["pseudo"].'</b> à '.$fin.' lors du pointage n°'.$idP.' !
    </div>';
                            }
                        }


                        echo '<h2>Débadger <b>' . $req[0]["pseudo"] . '</b> lors du pointage n°' . $idP . ' :</h2><br>';
                        echo '<form method="POST" action="debadger.php?id=' . $idP . '">';
                        echo '<label>Heure de début : <input name="debut" type="text" value="' . $req[0]["heureDébut"] . '" disabled/></label>
<label>Heure de fin : <input name="fin" type="text" placeholder="20:00:00"></label><label><input type="checkbox" name="huitheures"> A travaillé 8 heures</label><br>
<button type="submit" class="btn btn-danger">Débadger</button> (Le client sera débadgé a 20:00:00 si le champ n\'est pas rempli)
</form>';

                    }
                }
            }
        }
    }
}

?>