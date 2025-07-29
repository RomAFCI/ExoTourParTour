<?php

// Classe parente Personnage
class Personnage {
    protected $nom;
    protected $vie;
    protected $force;
    
    public function __construct($nom, $vie, $force) {
        $this->nom = $nom;
        $this->vie = $vie;
        $this->force = $force;
    }
    
    public function attaquer(Personnage $adversaire) {
        $degats = $this->force;
        $this->afficherMessage($this->nom . " attaque " . $adversaire->getNom() . " et inflige " . $degats . " dégâts !");
        $adversaire->recevoirDegats($degats);
    }
    
    public function recevoirDegats($degats) {
        $this->vie -= $degats;
        if ($this->vie < 0) {
            $this->vie = 0;
        }
    }
    
    public function afficherEtat() {
        return $this->nom . " - Vie: " . $this->vie . " PV";
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getVie() {
        return $this->vie;
    }
    
    public function estVivant() {
        return $this->vie > 0;
    }
    
    protected function afficherMessage($message) {
        global $messages;
        $messages[] = $message;
    }
}

// Classe Guerrier
class Guerrier extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 120, 15);
    }
}

// Classe Voleur
class Voleur extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 100, 12);
    }
    
    public function recevoirDegats($degats) {
        // 30% de chance d'esquiver
        if (rand(1, 100) <= 30) {
            $this->afficherMessage($this->nom . " esquive l'attaque ! Aucun dégât subi.");
            return;
        }
        parent::recevoirDegats($degats);
    }
}

// Classe Magicien
class Magicien extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 90, 8);
    }
    
    public function attaquer(Personnage $adversaire) {
        $degats = $this->force;
        $message = "";
        
        // 50% de chance de lancer un sort spécial
        if (rand(1, 100) <= 50) {
            $degats *= 2;
            $message = $this->nom . " lance un sort spécial ! ";
        }
        
        $message .= $this->nom . " attaque " . $adversaire->getNom() . " et inflige " . $degats . " dégâts !";
        $this->afficherMessage($message);
        $adversaire->recevoirDegats($degats);
    }
}

// Fonction pour créer un personnage selon le choix
function creerPersonnage($type, $nom) {
    switch ($type) {
        case 'guerrier':
            return new Guerrier($nom);
        case 'voleur':
            return new Voleur($nom);
        case 'magicien':
            return new Magicien($nom);
        default:
            return new Guerrier($nom);
    }
}

// Fonction pour générer un adversaire aléatoire
function genererAdversaire() {
    $types = ['guerrier', 'voleur', 'magicien'];
    $noms = ['Orc Brutal', 'Gobelin Sournois', 'Sorcier Noir'];
    
    $typeAleatoire = $types[array_rand($types)];
    $nomAleatoire = $noms[array_rand($noms)];
    
    return creerPersonnage($typeAleatoire, $nomAleatoire);
}

// Variables globales pour les messages de combat
$messages = [];
$resultatCombat = "";
$joueur = null;
$adversaire = null;

// Traitement du formulaire
if ($_POST && isset($_POST['personnage'])) {
    $choixJoueur = $_POST['personnage'];
    $nomJoueur = isset($_POST['nom']) && !empty($_POST['nom']) ? $_POST['nom'] : 'Héros';
    
    // Création des personnages
    $joueur = creerPersonnage($choixJoueur, $nomJoueur);
    $adversaire = genererAdversaire();
    
    $messages[] = "=== DÉBUT DU COMBAT ===";
    $messages[] = "Votre personnage : " . get_class($joueur) . " - " . $joueur->getNom();
    $messages[] = "Votre adversaire : " . get_class($adversaire) . " - " . $adversaire->getNom();
    $messages[] = "";
    
    $tour = 1;
    
    // Boucle de combat
    while ($joueur->estVivant() && $adversaire->estVivant()) {
        $messages[] = "=== TOUR " . $tour . " ===";
        
        // Tour du joueur
        $messages[] = ">> Tour du joueur :";
        $joueur->attaquer($adversaire);
        
        // Vérifier si l'adversaire est encore vivant
        if (!$adversaire->estVivant()) {
            break;
        }
        
        // Tour de l'adversaire
        $messages[] = ">> Tour de l'adversaire :";
        $adversaire->attaquer($joueur);
        
        $messages[] = "État après le tour " . $tour . " :";
        $messages[] = $joueur->afficherEtat();
        $messages[] = $adversaire->afficherEtat();
        $messages[] = "";
        
        $tour++;
    }
    
    // Résultat du combat
    $messages[] = "=== FIN DU COMBAT ===";
    if ($joueur->estVivant()) {
        $resultatCombat = "🎉 Victoire ! " . $joueur->getNom() . " remporte le combat !";
    } else {
        $resultatCombat = "💀 Défaite ! " . $adversaire->getNom() . " remporte le combat !";
    }
    
    $messages[] = "État final :";
    $messages[] = $joueur->afficherEtat();
    $messages[] = $adversaire->afficherEtat();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Jeu de Combat Tour par Tour</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f0f0;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .personnage-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f8f8;
            border-radius: 5px;
        }
        
        .personnage-card {
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .personnage-card h3 {
            margin-top: 0;
            color: #333;
        }
        
        .stats {
            font-size: 14px;
            color: #666;
        }
        
        .particularite {
            font-style: italic;
            color: #007bff;
            margin-top: 5px;
        }
        
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        
        .combat-log {
            background-color: #1e1e1e;
            color: #00ff00;
            padding: 20px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            margin-top: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
        
        .combat-log div {
            margin-bottom: 5px;
        }
        
        .resultat {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
        }
        
        .victoire {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .defaite {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .nouveau-combat {
            text-align: center;
            margin-top: 20px;
        }
        
        .nouveau-combat button {
            background-color: #28a745;
        }
        
        .nouveau-combat button:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚔️ Mini Jeu de Combat Tour par Tour ⚔️</h1>
        
        <?php if (!$_POST): ?>
            <form method="POST">
                <div class="form-group">
                    <label for="nom">Nom de votre héros :</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez le nom de votre personnage" value="Héros">
                </div>
                
                <div class="form-group">
                    <label for="personnage">Choisissez votre classe :</label>
                    <select id="personnage" name="personnage" required>
                        <option value="">-- Sélectionnez un personnage --</option>
                        <option value="guerrier">Guerrier</option>
                        <option value="voleur">Voleur</option>
                        <option value="magicien">Magicien</option>
                    </select>
                </div>
                
                <div class="personnage-info">
                    <div class="personnage-card">
                        <h3>🛡️ Guerrier</h3>
                        <div class="stats">Vie: 120 PV | Force: 15</div>
                        <div class="particularite">Dégâts constants, bonne résistance</div>
                    </div>
                    
                    <div class="personnage-card">
                        <h3>🗡️ Voleur</h3>
                        <div class="stats">Vie: 100 PV | Force: 12</div>
                        <div class="particularite">30% de chance d'esquiver les attaques</div>
                    </div>
                    
                    <div class="personnage-card">
                        <h3>🔮 Magicien</h3>
                        <div class="stats">Vie: 90 PV | Force: 8</div>
                        <div class="particularite">50% de chance de doubler les dégâts</div>
                    </div>
                </div>
                
                <button type="submit">🚀 Commencer le Combat !</button>
            </form>
        <?php else: ?>
            <div class="combat-log">
                <?php foreach ($messages as $message): ?>
                    <div><?php echo htmlspecialchars($message); ?></div>
                <?php endforeach; ?>
            </div>
            
            <?php if ($resultatCombat): ?>
                <div class="resultat <?php echo $joueur->estVivant() ? 'victoire' : 'defaite'; ?>">
                    <?php echo $resultatCombat; ?>
                </div>
            <?php endif; ?>
            
            <div class="nouveau-combat">
                <form method="GET">
                    <button type="submit">🔄 Nouveau Combat</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>