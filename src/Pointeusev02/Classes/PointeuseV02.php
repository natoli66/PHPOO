<?php

namespace PointeuseV02;

Class PointeuseV02{
    private $_pdo;

    public function __construct(){
        $this->_pdo = PDOPointeuse::getPdoPointeuse();
    }

    public function badger($idClient,$heure=false,$jour=false){
        if($heure){
            if($jour){
                $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient = $idClient AND heureFin = '' AND jourPointage = '$jour'");
                if($req){
                    return "Erreur, vous essayer de badger sans avoir débadgé.";
                }
                else{
                    $this->_pdo->requeteAction("INSERT INTO Pointeuse VALUES ('',$idClient,'$jour','$heure','')");
                }
            }else{
                $jour=date("j:n:Y");
                $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient = $idClient AND heureFin = '' AND jourPointage = '$jour'");
                if($req){
                    return "Erreur, vous essayer de badger sans avoir débadgé.";
                }
                else{
                    $this->_pdo->requeteAction("INSERT INTO Pointeuse VALUES ('',$idClient,'$jour','$heure','')");
                }
            }
        }else{
            $heure=date("G:i:s");
            if($jour){
                $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient = $idClient AND heureFin = '' AND jourPointage = '$jour'");
                if($req){
                    return "Erreur, vous essayer de badger sans avoir débadgé.";
                }
                else{
                    $this->_pdo->requeteAction("INSERT INTO Pointeuse VALUES ('',$idClient,'$jour','$heure','')");
                }
            }else{
                $jour=date("j:n:Y");
                $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient = $idClient AND heureFin = '' AND jourPointage = '$jour'");
                if($req){
                    return "Erreur, vous essayer de badger sans avoir débadgé.";
                }
                else{
                    $this->_pdo->requeteAction("INSERT INTO Pointeuse VALUES ('',$idClient,'$jour','$heure','')");
                    return "Vous avez bien badgé à ".$heure." le ".$jour;
                }
            }

        }
    }

    public function debadger($idClient,$idP=false,$heure=false,$admin=0)
    {
        if ($admin) {
            $this->_pdo->requeteAction("UPDATE Pointeuse SET heureFin = '$heure' WHERE idPointage = $idP");
        } else {
            $jour = date("j:n:Y");
            $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient = $idClient AND heureFin = '' AND jourPointage = '$jour'");
            if (!$req) {
                echo "Erreur, vous essayer de débadger sans avoir badgé.";
            } else {
                $idP = $req[0]['idPointage'];
                $heure = date("G:i:s");
                $this->_pdo->requeteAction("UPDATE Pointeuse SET heureFin = '$heure' WHERE idPointage = $idP");
                return "Vous avez bien débadgé à ".$heure." le ".$jour;
            }
        }
    }

    public function lastPointage($idClient){
        $req = $this->_pdo->requeteSelection("SELECT * FROM Pointeuse WHERE idClient=$idClient AND heureFin != '' ORDER BY idPointage DESC");
        if($req){
            $dernierPointage = array("id" => $req[0]['idPointage'],"jour" => $req[0]['jourPointage'],"début" => $req[0]['heureDébut'],"fin" => $req[0]['heureFin']);
            return $dernierPointage;
        }else{
            return false;
        }
    }

    public function heuresCumulées($idClient=false,$idPointage=false,$fin=false){
        if(!$idClient && !$idPointage){
            //Pour tous
        }elseif($idClient && !$idPointage){
                //Pour tous ses pointages
            }else{
            if(!$fin) {
                $req = $this->_pdo->requeteSelection("SELECT heureDébut,heureFin FROM Pointeuse WHERE idPointage=$idPointage AND heureFin != '' ");
                if ($req) {
                    $totalsecondes = strtotime($req[0]['heureFin']) - strtotime($req[0]['heureDébut']);
                    $heures = (int)($totalsecondes / 3600);
                    $minutes = (int)($totalsecondes / 60 - $heures * 60);
                    $secondes = $totalsecondes - $minutes * 60 - $heures * 3600;
                    $resultat = array("h" => $heures, "m" => $minutes, "s" => $secondes);
                    return $resultat;
                } else {
                    return 'Pointage non existant ou pas encore finit';
                }
            }else{
                $req = $this->_pdo->requeteSelection("SELECT heureDébut,heureFin FROM Pointeuse WHERE idPointage=$idPointage ");
                if ($req) {
                    $totalsecondes = strtotime($fin) - strtotime($req[0]['heureDébut']);
                    $heures = (int)($totalsecondes / 3600);
                    $minutes = (int)($totalsecondes / 60 - $heures * 60);
                    $secondes = $totalsecondes - $minutes * 60 - $heures * 3600;
                    $resultat = array("h" => $heures, "m" => $minutes, "s" => $secondes,"total" => $totalsecondes);
                    return $resultat;
                } else {
                    return 'Pointage non existant ou pas encore finit';
                }
            }
        }
    }

    public function nbPointages($idClient=false,$fini=false){
        if(!$idClient){
            if(!$fini){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse");
                return $req[0]['total'];
            }
            elseif($fini==1){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse WHERE heureFin != '' ");
                return $req[0]['total'];
            }elseif($fini==2){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse WHERE heureFin = '' ");
                return $req[0]['total'];
            }

        }else{
            if(!$fini){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse WHERE idClient = $idClient");
                return $req[0]['total'];
            }
            elseif($fini==1){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse WHERE heureFin != '' AND idClient=$idClient ");
                return $req[0]['total'];
            }elseif($fini==2){
                $req = $this->_pdo->requeteSelection("SELECT COUNT(*) AS total FROM Pointeuse WHERE heureFin = '' AND idClient=$idClient");
                return $req[0]['total'];
            }
            return "Paramères incorrectes !";
        }
    }
}
date_default_timezone_set("EUROPE/Paris");
?>