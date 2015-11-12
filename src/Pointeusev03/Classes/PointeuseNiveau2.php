<?php

namespace PointeuseV03;

Class PointeuseNiveau2 extends PointeuseBase{
    private $_pondération;

    public function heuresCumulées(){
        if($this->_heuresCumulées != null){
            $totalsecondes = parent::heuresCumulées()["total"] * 1.4;
            $heures = (int)($totalsecondes / 3600);
            $minutes = (int)($totalsecondes / 60 - $heures * 60);
            $secondes = (int)($totalsecondes - $minutes * 60 - $heures * 3600);
            $this->_pondération = array("h" => $heures, "m" => $minutes, "s" => $secondes);
            return $this->_pondération;
            echo "Votre temps de travail a été augmenté de 40%";
        }
    }
}
?>