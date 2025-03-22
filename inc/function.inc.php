<?php
session_start(); // Démarre la session
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['joueur'])) {
    $_SESSION['joueur'] = null; // Initialise la variable de session si elle n'existe pas
}
#### Constante pour définir le chemin du site
define("RACINE_SITE", "http://localhost/club_graziani_alexandre/");

#### Création d'une fonction alerte
function alert(string $message, int $idAlert, string $type = "danger"): string
{
    return "<div class='alert$idAlert alert-$type' role='alert'>
    $message
    <i class='fa-solid fa-xmark' id='close$idAlert'></i></div>";
}

#### Fonction pour debuger
function debug($variable): void
{
    echo "<pre class='debug'>";
    echo "<h2>Debug</h2>";
    var_dump($variable);
    echo "</pre>";
}

#### Fonction pour la connexion à la Base de Données

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "club_graziani_alexandre");

function connexionBDD(): object
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // echo "Je suis connecté à la BDD";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    return $pdo;
}

#### Fonction pour ajouter un utilisateur
function addPlayer(string $nom, string $prenom, string $email, string $password): void
{
    $players = [
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'motdepasse' => $password
    ];

    foreach ($players as $key => $value) {
        $players[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    $pdo = connexionBDD();
    $sql = "INSERT INTO joueurs (nom, prenom, email, mdp) VALUES (:n, :p, :em, :pwd)";
    $request = $pdo->prepare($sql); 
    $request->bindValue(':n', $players['nom'], PDO::PARAM_STR);
    $request->bindValue(':p', $players['prenom'], PDO::PARAM_STR);
    $request->bindValue(':em', $players['email'], PDO::PARAM_STR);
    $request->bindValue(':pwd', password_hash($players['motdepasse'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $request->execute();
}

#### Fonction pour vérifier si l'email existe déjà
function checkEmailPlayer(string $email): mixed
{
    $pdo = connexionBDD();
    $sql = "SELECT email FROM joueurs WHERE email = :email";
    $request = $pdo->prepare($sql);
    $request->bindValue(':email', $email, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch();
    return $result;
}

#### Fonction pour vérifier si l'email et le nom existent déjà, et correspondent
function checkEmailNamePlayer($email, $nom): mixed
{
    $pdo = connexionBDD();
    $sql = "SELECT * FROM joueurs WHERE email = :email AND nom = :n";
    $request = $pdo->prepare($sql);
    $request->bindValue(':email', $email, PDO::PARAM_STR);
    $request->bindValue(':n', $nom, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch();
    return $result;
}

#### Afficher tous les utilisateurs dans le dashboard
function allPlayers(): mixed
{
    $pdo = connexionBDD();
    $sql = "SELECT * FROM joueurs";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}


?>