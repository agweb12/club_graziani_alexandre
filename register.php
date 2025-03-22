<?php
$title = "S'inscrire";
$description = "S'inscrire en tant que joueur de foot du Club de Alexandre Graziani";
$keywords = "inscription, club, foot, graziani, alexandre";
$robots = "index, follow";
require_once("inc/function.inc.php");
if (isset($_SESSION['joueur'])) {
    header("location:profil.php");
}

$info = "";
$players = allPlayers();

if (!empty($_POST)) {
    $verification = true;

    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $verification = false;
        }
    }

    if ($verification === false) {
        $info .= alert("Veuillez renseigner tous les champs", 1, "danger");
    } else {
        # vérification de l'existence du nom du joueur et de sa longueur
        if (!isset($_POST['nom']) || strlen(trim($_POST['nom'])) > 50 || strlen(trim($_POST['nom'])) < 2) {
            $info = alert("Le champs nom n'est pas valide", 2, "danger");
        }

        # vérification de l'existence du prénom du joueur et de sa longueur
        if (!isset($_POST['prenom']) || strlen(trim($_POST['prenom'])) > 50 || strlen(trim($_POST['prenom'])) < 2) {
            $info .= alert("Le champs prénom n'est pas valide", 3, "danger");
        }

        # vérification du mail du joueur
        if (!isset($_POST['email']) || strlen(trim($_POST['email'])) > 100 || strlen(trim($_POST['email'])) < 6 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $info .= alert("Le champs mail n'est pas valide", 4, "danger");
        }

        # vérification du mot de passe du joueur
        $regexMdp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        if (!isset($_POST['password']) || !preg_match($regexMdp, $_POST['password'])) {
            $info .= alert("Le mot de passe n'est pas valide", 5, "danger");
        }

        if (!isset($_POST['confirmPassword']) || $_POST['password'] !== $_POST['confirmPassword']) {
            $info .= alert("Le mot de passe de confirmation n'est pas valide", 6, "danger");
        }

        if (empty($info)) {
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            //Hashage du mot de passe et stockage de ce dernier
            $passwordHash = password_hash($mdp, PASSWORD_DEFAULT);

            $emailExist = checkEmailPlayer($email);

            $emailNameExist = checkEmailNamePlayer($email, $nom);

            #Vérification si l'email existe dans la BDD
            if ($emailExist) {
                $info = alert("L'email existe déjà", 7, "warning");
            }

            // #vérification si l'email et le nom correspondent au même joueur de football
            if ($emailNameExist) {
                $info = alert("Vous avez déjà un compte utilisateur", 8, "info");
            } elseif (empty($info)) {
                addPlayer($nom, $prenom, $email, $passwordHash);
                $info = alert("Vous êtes bien inscrit, vous pouvez vous connectez <a href='login.php' class='text-danger fw-bold'>ici</a>", 9, "success");
            }
        }
    }
}
require_once("inc/header.inc.php");
?>
<h1>S'inscrire au Club de Alexandre Graziani</h1>
<?= $info; ?>
<form action="" method="post">
    
    <div class="input-form">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Entrez votre nom">
    </div>
    <div class="input-form">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prenom">
    </div>
    <div class="input-form">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Entrez votre email">
    </div>
    <div class="input-form">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">
    </div>
    <div class="input-form">
        <label for="confirmPassword">Confirmer le Mot de Passe</label>
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmez votre mot de passe">
    </div>
    <div class="input-form">
        <button type="submit" class="registerForm">S'inscrire</button>
        <p>Vous avez dèjà un compte ? <a href="login.php" class="linkForm">connectez-vous ici</a></p>
    </div>
</form>
    <h2>Liste des utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?= $player['id_joueur'] ?></td>
                    <td><?= $player['nom'] ?></td>
                    <td><?= $player['prenom'] ?></td>
                    <td><?= $player['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
require_once("inc/footer.inc.php");
?>