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

if(isset($_POST['id']) && isset($_POST['mdp'])) {
    $pseudo = htmlspecialchars($_POST['id']);
    $mdp = htmlspecialchars($_POST['mdp']);

    if ($mdp == "" || $pseudo == "") {
        $_SESSION['err_co'] = "Veuillez remplir les champs ci-dessous !";
    } else {

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $pdo = PDOPointeuse::getPdoPointeuse();
        $connection = $pdo->requeteSelection("select * from client where password='$mdp' and pseudo='$pseudo'");
        if ($connection) {
            $_SESSION['site'] = 1;
            $_SESSION['pseudo'] = $pseudo;
            if ($_SESSION['err_co']) {
                unset($_SESSION['err_co']);
            }
        } else {
            $_SESSION['err_co'] = "Vous avez rentr&eacute; un mauvais identifiant/mot de passe !";
        }
    }
}
else{
}
header('Location: ../Public/connexion.php');

?>
</body>
</html>