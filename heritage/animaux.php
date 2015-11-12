<?php

abstract class Animal
{
    protected $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    abstract public function parler();			//// pas de corps
}

class Chien extends Animal
{
    public function parler()
    {									//// corps de la méthode
        echo "$this->nom: Wouf Wouf <br>";
    }
}

class Chat extends Animal
{
    public function parler()
    {
        echo "$this->nom: Miaou <br>";
    }
}

$chien = new Chien("Rex");
$chien->parler(); // Rex: Wouf Wouf

$chat = new Chat("Sac-a-puces");
$chat->parler();  // Sac-a-puces: Miaou

?>
