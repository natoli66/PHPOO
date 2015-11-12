<?php

interface Forme2D
{
    // toutes les formes en deux dimension ont une aire...
    public function obtenirAire();

    // ... et un périmètre
    public function obtenirPerimetre();
}

class Carre implements Forme2D   //la classe carre implémente l’interface Forme2D
{
    protected $cote;

    public function __construct($cote)
    {
        $this->cote = $cote;
    }

    public function obtenirAire()		// ON donne un CORPS à la méthode obtenirAire
    {
        return pow($this->cote, 2);		// pow ⇒ puissance ⇒ on récupère le coté au carré
    }

    public function obtenirPerimetre()
    {
        return 4 * $this->cote;
    }
}

class Rectangle implements Forme2D
{
    protected $longueur;
    protected $largeur;

    public function __construct($longueur, $largeur)
    {
        $this->longueur = $longueur;
        $this->largeur = $largeur;
    }

    public function obtenirAire()
    {
        return $this->longueur * $this->largeur;
    }

    public function obtenirPerimetre()
    {
        return 2 * ($this->longueur + $this->largeur);
    }
}

class Cercle implements Forme2D
{
    protected $rayon;

    public function __construct($rayon)
    {
        $this->rayon = $rayon;
    }

    public function obtenirAire()
    {
        return M_PI * pow($this->rayon, 2);
    }

    public function obtenirPerimetre()
    {
        return M_PI * ($this->rayon * 2);
    }
}

class Triangle implements Forme2D
{
    protected $a;
    protected $b;
    protected $c;

    public function __construct($a,$b,$c){
        $this->a=$a;
        $this->b=$b;
        $this->c=$c;
    }

    public function obtenirAire(){
        $s = ($this->a + $this->b + $this->c)/2;
        return sqrt($s*($s-$this->a)*($s -$this->b)*($s -$this->c));
    }

    public function obtenirPerimetre(){

    }
}




class Figure2D
{
    protected $formes;

    public function ajouter(Forme2D $forme)		//la méthode ajouter prend en paramètre
    {								// $forme qui doit être de type Forme2D
        $this->formes[] = $forme;		// ON ajoute au tableau $this->formes l’objet $forme
    }

    public function surfaceTotale()
    {
        $surface = 0;
        foreach ($this->formes as $forme)
            $surface += $forme->obtenirAire();

        return $surface;
    }
}

$figure = new Figure2D;
$figure->ajouter(new Cercle(3));
$figure->ajouter(new Carre(4));
$figure->ajouter(new Rectangle(5,6));
$figure->ajouter(new Triangle(4,3,5));

echo "Ces trois figures ont une surface totale de " . $figure->surfaceTotale(); // 74.27...

?>
