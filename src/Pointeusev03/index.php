<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<?php
date_default_timezone_set("EUROPE/Paris");

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    require __DIR__."/Classes/".end($parts) . '.php';
});

use PointeuseV03\PointeuseNiveau1;
use PointeuseV03\PointeuseNiveau2;
use PointeuseV03\PointeuseNiveau3;

$P1 = new PointeuseNiveau1();

echo "<h1>Pointeuse Niveau 1</h1>";
echo "Appelle de la méthode badger à 1:00:00<br>";
$P1->badger("1:00:00");
echo "Appelle de la méthode débadger à 12:00:00<br>";
$P1->debadger("12:00:00");
echo "Var_dump de la méthode risque :";
var_dump($P1->risque());


$P2 = new PointeuseNiveau2();

echo "<h1>Pointeuse Niveau 2</h1>";
echo "Appelle de la méthode badger à 1:00:00<br>";
$P2->badger("1:00:00");
echo "Appelle de la méthode débadger à 11:00:00<br>";
$P2->debadger("11:00:00");
echo "Var_dump de la nouvelle méthode heuresCumulées :";
var_dump($P2->heuresCumulées());


$P3 = new PointeuseNiveau3();

echo "<h1>Pointeuse Niveau 3</h1>";
echo "Appelle de la méthode badger à 1:00:00<br>";
$P3->badger("1:00:00");
echo "Appelle de la méthode débadger à 11:00:00<br>";
$P3->debadger("11:00:00");
echo "Var_dump de la nouvelle méthode heuresCumulées :";
var_dump($P3->heuresCumulées());
echo "Var_dump de la méthode estContaminé :";
var_dump($P3->estContaminé());

?>
</body>
</html>