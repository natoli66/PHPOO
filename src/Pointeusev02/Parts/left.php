<?php
spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    require __DIR__."/../Classes/".end($parts) . '.php';
});

use PointeuseV02\PDOPointeuse;
use PointeuseV02\PointeuseV02;

$Pointeuse = new PointeuseV02();


echo '<div class="col-md-2" id="left-side">';
if(isset($_SESSION['site'])){
    $pseudo = $_SESSION['pseudo'];
    $pdo = PDOPointeuse::getPdoPointeuse();
    $req = $pdo->requeteSelection("SELECT * FROM client WHERE pseudo='$pseudo'");
    $compte = $req[0];
    $_SESSION['id']=$compte['idClient'];
    echo '<h2>Pseudo : <b>'.$pseudo.'</b></h2>';
    echo '<h2>ID Compte : <b>'.$_SESSION['id'].'</b></h2>';
    $lastP = $Pointeuse->lastPointage($_SESSION['id']);
    if($lastP){
        echo '<h2>Denier Pointage : ';
        echo '<ul><li>Jour=<b>'.$lastP["jour"].'</b></li>';
        echo '<li>Début=<b>'.$lastP["début"].'</b></li>';
        echo '<li>Fin=<b>'.$lastP['fin'].'</b></li>';
        $cumul = $Pointeuse->heuresCumulées($_SESSION['id'],$lastP['id']);
        echo '<li>Durée=<b>'.$cumul["h"].'h '.$cumul["m"].'m '.$cumul["s"].'s</b></li></ul></h2>';
    }
    if($Pointeuse->nbPointages($_SESSION['id'])!=0) {
        echo '<h2>Nombre Pointages : <b>' . $Pointeuse->nbPointages($_SESSION['id']) . '</b></h2>';
    }

}?></div>