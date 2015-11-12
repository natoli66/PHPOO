<?php

namespace PointeuseV02;
use PDO;

class PDOPointeuse {

    private static $serveur = "mysql:host=localhost";
    private static $bdd = "dbname=Pointeuse";
    private static $user = "Pointeuse";
    private static $mdp = "Pointeuse";
    private static $monPdo;
    private static $monPdoPointeuse = null;

    private function __construct() {
        PDOPointeuse::$monPdo = new PDO(PDOPointeuse::$serveur . ';' . PDOPointeuse::$bdd, PDOPointeuse::$user, PDOPointeuse::$mdp);
        PDOPointeuse::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct() {
        PDOPointeuse::$monPdo = null;
    }

    public static function getPdoPointeuse() {
        if (PDOPointeuse::$monPdoPointeuse == null) {
            PDOPointeuse::$monPdoPointeuse = new PDOPointeuse();
        }
        return PDOPointeuse::$monPdoPointeuse;
    }

    public function requeteAction($requete) {

        $nbLignes = PDOPointeuse::$monPdo->exec($requete);

        return $nbLignes;
    }

    public function requeteSelection($requete) {
        $resultats = PDOPointeuse::$monPdo->query($requete);
        return $resultats->fetchall(PDO::FETCH_NAMED);
    }

}

?>
