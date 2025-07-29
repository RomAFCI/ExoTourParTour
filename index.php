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

    // Setter

    // Method

    public function attaquer(Perso $adversaire) {}

    public function recevoirDegats(int $degats) {}

    public function afficherEtat() {}
}

// class enfants
class Guerrier extends Perso {

public function __construct($nom, $pv, $atk) {
    $nom->nom = $nom;
    $pv->pv = "120";
    $atk->atk = "15";

// Particularité : dégâts constants, bonne résistance.

}
}

class Voleur extends Perso {

public function __construct($nom, $pv, $atk) {
    $nom->nom = $nom;
    $pv->pv = "100";
    $atk->atk = "12";

// Particularité : a une chance (30%) d’esquiver une attaque (aucun dégât subi).

}
}

class Magicien extends Perso {

public function __construct($nom, $pv, $atk) {
    $nom->nom = $nom;
    $pv->pv = "90";
    $atk->atk = "8";

// Particularité : a une chance (50%) de lancer un sort spécial qui double les dégâts infligés.

}
}

$warrior1 = new Guerrier('Barbarius', 120, 15);

var_dump($warrior1);
