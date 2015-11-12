<?php

namespace PointeuseV03;

Class PointeuseNiveau1 extends PointeuseBase{

    public function risque(){
        if($this->heuresCumulées()["h"] >= 11){
            return true;
        }
        else{
            return false;
        }
    }
}
?>