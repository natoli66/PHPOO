<?php session_start();?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Pointage</title>
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

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    require __DIR__."/../Classes/".end($parts) . '.php';
});

use PointeuseV02\PDOPointeuse;
use PointeuseV02\PointeuseV02;

$pdo = PDOPointeuse::getPdoPointeuse();
$Pointeuse = new PointeuseV02();
if(isset($_SESSION['pseudo']) && isset($_SESSION['id'])){

                $pseudo = $_SESSION['pseudo'];
                $id = $_SESSION['id'];
                $req = $pdo->requeteSelection("select * from client where pseudo='$pseudo' ");

                    if ($req[0]['admin']) { ?>

                        <form id="nbPointages" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            Nombre de pointages par page :
                            <select name="PPP">
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                            </select>
                            <input type="submit" value="Trier">
                        </form>

                        <?php
                        if(isset($_POST['PPP'])){
                            $PPP = $_POST['PPP'];
                            $limite=0;
                            if(isset($_GET['page'])) {
                                $limite = $_GET['page']*$PPP;
                            }

                        }else{
                            $PPP=25;
                        }
                        $clientspointés = $pdo->requeteSelection("SELECT DISTINCT(pseudo) FROM Pointeuse,client WHERE pointeuse.idClient=client.idClient");
                        echo '<form method="post" action="#">';
                        $nbPointages = 0;
                        foreach($clientspointés as $client){
                            $pseudoclient = $client['pseudo'];
                            if($nbPointages < $PPP) {
                                echo '<fieldset><legend>Pointages de <b>' . $pseudoclient . '</b></legend><table class="table table-striped table-hover"><thead><tr><th>numeroPointage</th><th>idPointage</th><th>jourPointage</th><th>débutPointage</th><th>finPointage</th></tr></thead><tbody>';
                                $pointages = $pdo->requeteSelection("SELECT * FROM Pointeuse,client WHERE pseudo='$pseudoclient' AND pointeuse.idClient=client.idClient");
                                $i = 1;
                                foreach ($pointages as $pointage) {
                                    echo '<tr><td>' . $i . '</td>
                                <td>' . $pointage["idPointage"] . '</td>
                                <td>' . $pointage["jourPointage"] . '</td>
                                <td>' . $pointage["heureDébut"] . '</td>
                                <td>';
                                    if ($pointage["heureFin"] != "") {
                                        echo $pointage["heureFin"];
                                    } else {
                                        echo '<a href="../Admin/debadger.php?id=' . $pointage["idPointage"] . '" ><span class="glyphicon glyphicon-remove"> Débadger</span></a>';
                                    }
                                    echo '</td>
                                </tr>';
                                    $i++;
                                    $nbPointages++;
                                }
                                echo '</tbody></table></fieldset>';
                            }
                        }
                        echo '</form>';
                    } else {
                        if(isset($_POST['debadger'])){
                            echo $Pointeuse->debadger($id);
                        }elseif(isset($_POST['badger'])){
                            echo $Pointeuse->badger($id);
                        }
                        echo '<form action="#" method="POST">La fonction sera exécutée avec comme paramètre la date actuelle (le '.date("j:n:Y").' à '.date("G:i:s").') :<br>Que voulez vous faire ?<br><br><input type="submit" name="badger" value="Badger"/><input type="submit" name="debadger" value="Debadger"/></form>';
                    }

                }else {
                echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    Vous devez être connecté pour pouvoir pointer !
    </div>';
            }
?>
        </div>
    </div>
</div>
<?php include '../Parts/footer.php';?>
</body>
</html>