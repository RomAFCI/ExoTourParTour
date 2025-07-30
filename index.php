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

    public function attaquer(Perso $adversaire)
    {
        echo $this->nom . " attaque " . $adversaire->getNom() . " et lui inflige " . $this->atk . " points de dégâts.<br>";
        $adversaire->recevoirDegats($this->atk);
    }

    public function recevoirDegats(int $degats)
    {
        $this->setPv($this->getPv() - $degats);
    }

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
// var_dump($guerrier);
// echo "<br>";

// var_dump($voleur);
// echo "<br>";

// var_dump($magicien);
// echo "<br>";

// var_dump($roublard);
// echo "<br>";
// echo "<hr>";
// En commentaire pour affichage web

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Combat au tour par tour</h2>
    <h4>Sélectionne ton personnage :</h4>
    <?php
    // afficher perso avec method etat + selectionnez le joueur 1 en href
    $guerrier->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=guerrier">Choisir ce personnage</a>';
    echo "<br>";
    echo "<br>";


    $voleur->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=voleur">Choisir ce personnage</a>';
    echo "<br>";
    echo "<br>";

    $magicien->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=magicien">Choisir ce personnage</a>';
    echo "<br>";
    echo "<br>";

    $roublard->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=roublard">Choisir ce personnage</a>';
    echo "<br>";
    echo "<br>";

    ?>

</body>

</html>

<?php
// utilisez le href avec GET + afficher la suite du jeu
if (isset($_GET['joueur1'])) {

    // BONUS : AFFICHER LE NOM DU PERSO CHOISI,
    $joueur1_nom = '';

    if ($_GET['joueur1'] == 'guerrier') {
        $joueur1_nom = $guerrier->nom;
    }
    if ($_GET['joueur1'] == 'voleur') {
        $joueur1_nom = $voleur->nom;
    }
    if ($_GET['joueur1'] == 'magicien') {
        $joueur1_nom = $magicien->nom;
    }
    if ($_GET['joueur1'] == 'roublard') {
        $joueur1_nom = $roublard->nom;
    }
    // le href est modifier on enchaine sur la suite du jeu
    echo "<hr>";
    echo "<br>";
    echo "Vous avez choisi " . $joueur1_nom . " !";
    echo "<br>";
    echo "<h4>Choisissez votre adversaire :</h4>";


    // Liens pour joueur 2 (on garde joueur1 dans l'URL)

    $guerrier->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=' . $_GET['joueur1'] . '&joueur2=guerrier">Choisir cet adversaire</a>';
    echo "<br>";
    echo "<br>";

    $voleur->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=' . $_GET['joueur1'] . '&joueur2=voleur">Choisir cet adversaire</a>';
    echo "<br>";
    echo "<br>";

    $magicien->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=' . $_GET['joueur1'] . '&joueur2=magicien">Choisir cet adversaire</a>';
    echo "<br>";
    echo "<br>";

    $roublard->afficherEtat();
    echo "<br>";
    echo '<a href="?joueur1=' . $_GET['joueur1'] . '&joueur2=roublard">Choisir cet adversaire</a>';
    echo "<br>";
    echo "<br>";
}


if (isset($_GET['joueur1']) && isset($_GET['joueur2'])) {

    $joueur1_nom = '';
    $joueur2_nom = '';

    if ($_GET['joueur1'] == 'guerrier') {
        $joueur1_nom = $guerrier->nom;
    }
    if ($_GET['joueur1'] == 'voleur') {
        $joueur1_nom = $voleur->nom;
    }
    if ($_GET['joueur1'] == 'magicien') {
        $joueur1_nom = $magicien->nom;
    }
    if ($_GET['joueur1'] == 'roublard') {
        $joueur1_nom = $roublard->nom;
    }

    if ($_GET['joueur2'] == 'guerrier') {
        $joueur2_nom = $guerrier->nom;
    }
    if ($_GET['joueur2'] == 'voleur') {
        $joueur2_nom = $voleur->nom;
    }
    if ($_GET['joueur2'] == 'magicien') {
        $joueur2_nom = $magicien->nom;
    }
    if ($_GET['joueur2'] == 'roublard') {
        $joueur2_nom = $roublard->nom;
    }

    echo "<hr><br>";
    echo "Votre adversaire sera " . $joueur2_nom . " !" . '<br>' . '<br>';
    echo "Préparez vous au combat final !";
    echo "<br><br>";

    // Définir les PV de départ pour chaque perso
    $pv1 = 0;
    $pv2 = 0;

    // Récupère les PV selon le perso choisi
    if ($_GET['joueur1'] == 'guerrier') {
        $pv1 = $guerrier->pv;
    }
    if ($_GET['joueur1'] == 'voleur') {
        $pv1 = $voleur->pv;
    }
    if ($_GET['joueur1'] == 'magicien') {
        $pv1 = $magicien->pv;
    }
    if ($_GET['joueur1'] == 'roublard') {
        $pv1 = $roublard->pv;
    }

    if ($_GET['joueur2'] == 'guerrier') {
        $pv2 = $guerrier->pv;
    }
    if ($_GET['joueur2'] == 'voleur') {
        $pv2 = $voleur->pv;
    }
    if ($_GET['joueur2'] == 'magicien') {
        $pv2 = $magicien->pv;
    }
    if ($_GET['joueur2'] == 'roublard') {
        $pv2 = $roublard->pv;
    }

    echo '<a href="index.php?joueur1=' . $_GET['joueur1'] . '&joueur2=' . $_GET['joueur2'] . '&pv1=' . $pv1 . '&pv2=' . $pv2 . '&action=attaque">Lancer le combat</a>';
}

// A REVOIR ⚠️
if (isset($_GET['joueur1']) && isset($_GET['joueur2']) && isset($_GET['action']) && $_GET['action'] === 'attaque') {

    // Réinstancier les personnages selon leur nom (tu peux factoriser ça plus tard si tu veux)
    if ($_GET['joueur1'] == 'guerrier') {
        $joueur1 = new Guerrier();
    } elseif ($_GET['joueur1'] == 'voleur') {
        $joueur1 = new Voleur();
    } elseif ($_GET['joueur1'] == 'magicien') {
        $joueur1 = new Magicien();
    } elseif ($_GET['joueur1'] == 'roublard') {
        $joueur1 = new Roublard('Aragorn', 130, 10);
    }

    if ($_GET['joueur2'] == 'guerrier') {
        $joueur2 = new Guerrier();
    } elseif ($_GET['joueur2'] == 'voleur') {
        $joueur2 = new Voleur();
    } elseif ($_GET['joueur2'] == 'magicien') {
        $joueur2 = new Magicien();
    } elseif ($_GET['joueur2'] == 'roublard') {
        $joueur2 = new Roublard('Aragorn', 130, 10);
    }

    echo "<hr>";
    echo "<h3>Début du combat</h3>";

    // Attaque
    $joueur1->attaquer($joueur2);

    // Affichage des états après attaque
    echo "<br><strong>État après attaque :</strong><br>";
    $joueur1->afficherEtat();
    echo "<br>";
    $joueur2->afficherEtat();

    // Relancer une attaque
    echo "<br><br><a href='?joueur1=" . $_GET['joueur1'] . "&joueur2=" . $_GET['joueur2'] . "&action=attaque'>Attaquer encore</a>";

    // Retour au début
    echo "<br><br><a href='index.php'>Reset</a>";
}


?>

<?php
echo '<hr>';
echo '<br>';
echo '<a href="index.php">Reset</a>';
?>