<?php
class validationFormulaire
{
    /* variable de classe privée, on met arbitrairement 
    un souligné après le $
    pour ne pas la confondre avec une variable normale*/
    var $_listeErreurs;
    var $_forbiddenChars ;
    //************************************************
    //methode pour regarder si la valeur n'a pas de 
    //chiffres ou autres symboles et renvoyer le résultat
    function estNom($champ, $errMessage)
    {
        /*on utilise une expression régulière (voir chaoitre 
        16) pour savoir si le nom a des chances d'être valide 
        aucun des caractères listés ci-après ne doit figurer 
        dans le non cela dans le but de constituer une aide à 
        la saisie plutôt de d'empêcher un faux nom */
        $valeur = $_POST[$champ] ;
        $pattern = "[]1234567890<\>\&\"\#\{\(\[\|\^\@\)" ;
        $pattern .= "\=\}\,\?\;\:\\\!\§\/\*\%\$\£\-\+\°]";
        $this->_forbiddenChars  = $pattern ;
        if (!preg_match($pattern, $valeur))
        {
            return true;
        }
        else
        {
            //on remplit la liste d'erreur avec le nom du champ, 
            //la valeur saisie, le message d'erreur à renvoyer
            $this->_listeErreurs[] = array("champ" => $champ,
                "valeur" => $valeur, "errMessage" => $errMessage);
            return false;
        }
    }
/////////////////////////fin de la classe///////////////////////
    // fonction pour renvoyer la liste des erreurs
    function getErrorList()
    {
        return $this->_listeErreurs;
    }
    // fonction pour dire si une erreur a eu lieu
    function erreur()
    {
        if (sizeof($this->_listeErreurs) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
//******************fin de la classe début du formulaire *********
//on regarde si le nom a déja été saisi
if (empty($_POST['nom']))
{
    //si le nom n'a pas été saisi, on envoi le formulaire
    //echo "<form action=$_SERVER[PHP_SELF] method=post>"; 
    echo "<form action=show_exercises.php?exercise=lesson_08_form_1.php 
        method=post>";
    echo "Entrez votre nom : <input type=text name=nom> ";
    echo "<input type='submit' value='valider'></form>";
}
else
{
    // on crée un objet en créant une instance de la classe
    $maValidation = new validationFormulaire();

    // perform validation ("nom" est ne nom du champ
    $maValidation->estNom("nom",
        "Ce champ contient des caractères interdits ");

    if ($maValidation->erreur())
    {
        $errors = $maValidation->getErrorList();

        echo "<b>L'opération n'a pas pu être effectuée 
          car une ou plusieurs
      informations sont manquantes ou mal saisies:</b> <p>";
        echo "<ul>";
        foreach ($errors as $err)
        {
            echo "<li>Dans le champ : ". $err['champ']. ",
             vous avez saisi : ". $err['valeur']." ". $err['errMessage'] ;
        }
        echo "</ul>";
        $Pattern = $maValidation->_forbiddenChars  ;
        echo "Note : Liste des caractères interdits <small>$Pattern</small>";
    }
    else
    {
        // do something useful with the data
        echo "Les données semblent valides";
    }
}
?>
