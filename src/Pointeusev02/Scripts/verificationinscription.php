<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
</head>
<body>
<?php
spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    require __DIR__."/../Classes/".end($parts) . '.php';
});
use PointeuseV02\PDOPointeuse;

if(isset($_POST['id']) && isset($_POST['mdp']) && isset($_POST['vmdp'])) {
    $pseudo = htmlspecialchars($_POST['id']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $vmdp = htmlspecialchars($_POST['vmdp']);

    if ($mdp == "" || $pseudo == "" || $vmdp == "") {
        $_SESSION['err_ins'] = "Veuillez remplir les champs ci-dessous !";
    } else {
        if($mdp == $vmdp){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $pdo = PDOPointeuse::getPdoPointeuse();
        $verif = $pdo->requeteSelection("select * from client where pseudo='$pseudo'");
        if ($verif) {
            $_SESSION['err_ins']= "Cet nom d'utilisateur est déjà pris !";
            }else {
            $req = $pdo->requeteAction("INSERT INTO client VALUES('','$pseudo','$mdp','')");
            $_SESSION['info_ins']= "Merci de votre inscription <b>$pseudo</b> !";
        }

    }else{
            $_SESSION['err_ins']= "Vous avez rentr&eacute; 2 mots de passes différents !";
        }

    }
}
header('Location: ../Public/inscription.php');

?>
</body>
</html>