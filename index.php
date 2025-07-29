<?php

// class parent
class Perso
{
    public $nom;
    public $pv;
    public $atk;

    // Constructor
    public function __construct($nom, $pv, $atk)
    {
        $this->nom = $nom;
        $this->pv = $pv;
        $this->atk = $atk;
    }

    // Getter

    public function getNom()
    {
        return $this->nom;
    }

    public function getPv()
    {
        return $this->pv;
    }

    public function getAtk()
    {
        return $this->atk;
    }

    // Setter

    public function setNom($nom)
    {

        return $this->nom = $nom;
    }
    public function setPv($pv)
    {
        return $this->pv = $pv;
    }
    public function setAtk($atk)
    {
        return $this->atk = $atk;
    }

    // Method

    public function attaquer(Perso $adversaire) {}

    public function recevoirDegats(int $degats) {}

    public function afficherEtat()
    {
        echo "$this->nom à $this->pv PV est $this->atk en ATK.";
    }
}

// class enfants
class Guerrier extends Perso
{

    public function __construct()
    {
        $this->nom = 'Barbarius';
        $this->pv = "120";
        $this->atk = "15";

        // Particularité : dégâts constants, bonne résistance.

    }
}

class Voleur extends Perso
{

    public function __construct()
    {
        $this->nom = 'Asterion';
        $this->pv = "100";
        $this->atk = "12";

        // Particularité : a une chance (30%) d’esquiver une attaque (aucun dégât subi).

    }
}

class Magicien extends Perso
{

    public function __construct()
    {
        $this->nom = 'Gandalf';
        $this->pv = "90";
        $this->atk = "8";

        // Particularité : a une chance (50%) de lancer un sort spécial qui double les dégâts infligés.

    }
}

class Roublard extends Perso
{
    public function __construct($nom, $pv, $atk)
    {
        $this->nom = $nom;
        $this->pv = $pv;
        $this->atk = $atk;
    }
}

// Declaration d'objet
$guerrier = new Guerrier();
$voleur = new Voleur();
$magicien = new Magicien();
$roublard = new Roublard('Aragorn', 130, 10);


// Results d'objet
var_dump($guerrier);
echo "<br>";

var_dump($voleur);
echo "<br>";

var_dump($magicien);
echo "<br>";

var_dump($roublard);
echo "<br>";
echo "<hr>";

// utiliser method sur objet
$guerrier->afficherEtat();
echo "<br>";
$voleur->afficherEtat();
echo "<br>";
$magicien->afficherEtat();
echo "<br>";
$roublard->afficherEtat();
echo "<br>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">

        <input type="radio" id="guerrier" name="persoSelectionner" value="guerrier" checked />
        <label for="guerrier">Guerrier</label>
        <br>

        <input type="radio" id="voleur" name="persoSelectionner" value="voleur" />
        <label for="voleur">Voleur</label>
        <br>

        <input type="radio" id="magicien" name="persoSelectionner" value="magicien" />
        <label for="magicien">Magicien</label>
        <br>

        <input type="radio" id="roublard" name="persoSelectionner" value="roublard" />
        <label for="roublard">Roublard</label>
        <br>

        <input type="submit" name="selectionnerJoueur">
        <br>

    </form>
</body>

</html>

<?php

if(isset($_POST[selectionnerJoueur]))