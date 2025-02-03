<?php
// include 'vendor/autoload.php';
include 'model/account.php';

function ajouterUtilisateur(PDO $bdd) {
    $message = "";
    //Test si le formulaire est soumis
    if(isset($_POST["submit"])) {

        // Récupération et nettoyage des données
        $firstname = trim(htmlspecialchars($_POST["firstname"]));
        $lastname = trim(htmlspecialchars($_POST["lastname"]));
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        //tester si les champs sont remplis
        if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) &&
        !empty($_POST["email"]) && !empty($_POST["password"])) {
            //tester si le mail est valide
            if(!preg_match(
                "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/",
                $_POST["email"])) {
                    $message .= "Le mail est invalide";
            }
            //tester si le mot de passe est valide
            if(!preg_match( "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{12,}$/",
            $_POST["password"])) {
                $message .= "Le mot de passe est invalide";
            }

            // Si aucune erreur, hashage du mot de passe
            if (empty($message)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                addAccount($bdd, [$firstname, $lastname, $email, $hashed_password]);
                $message = "Utilisateur ajouté avec succès.";
            }
        }
        else {
            $message = "Veuillez remplir tous les champs";
        }
    }
    return $message;
}
//Méthode pour récupérer l'extension d'un fichier
function generateUsersList(PDO $bdd){

    $users = getAllAccount($bdd);

    if(empty($users)) {
        return "<p>Aucun utilisateur trouvé</p>";
    }

    $output = "<ul>";
    foreach ($users as $user) {
        $output .= "<li>" . htmlspecialchars($user['firstname']) . " " . htmlspecialchars($user['lastname']) . " - " . htmlspecialchars($user['email']) . "</li>";
    }
    $output .= "</ul>";

    return $output;
}

function displayUser(PDO $bdd) {
    $message = ajouterUtilisateur($bdd);

    $output = generateUsersList($bdd);

    include 'vue/account.php';
}
?>