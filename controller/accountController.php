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

function signIn(PDO $bdd) {
    //Vérifier qu'on reçoit le formulaire
    $loginMessage = "";

    if(isset($_POST['connect'])){
        //Vérifier les champs vide
        if(empty($_POST['email']) || empty($_POST['password'])){
            //Retourne le message d'erreur
            return "Veuillez remplir tous les champs";
        }

        //Vérifier le format des données : ici l'email
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            //Retourne le message d'erreur
            return "Veuillez renseigner une adresse email valide";
        }

        //Nettoyer les données
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);

        $user = getAccountByEmail($bdd, $email);

        //Vérifier que l'utilisateur n'existe pas déjà en bdd
        if(empty($user)){
            //Retourne le message d'erreur
            return "Email et/ou mot de passe incorrect";
        }

        if (!password_verify($password, $user['password'])) {
            return "Email et/ou mot de passe incorrect";
        }

         // Enregistrement des informations en session
         $_SESSION['id'] = $user['id_account'];
         $_SESSION['firstname'] = $user['firstname'];
         $_SESSION['lastname'] = $user['lastname'];
         $_SESSION['email'] = $user['email'];

        //  header('location:/task_cda/');
        //  exit;
    
        return "Bienvenue " . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . ".";
    }
    return '';
}

function displayForm($message,$messageSignIn){
    $form = "";
    if(!isset($_SESSION['id'])){
        ob_start();
?>
    <section>
        <h1>Inscription</h1>
        <form action="" method="post">
            <input type="text" name="lastname" placeholder="Le Nom de Famille">
            <input type="text" name="firstname" placeholder="Le Prénom">
            <input type="text" name="email" placeholder="L\'Email">
            <input type="password" name="password" placeholder="Le Mot de Passe">
            <input type="submit" name="submitSignUp">
        </form>
        <p>'. $message .'</p>
    </section>
    <section>
        <h1>Connexion</h1>
        <form action="" method="post">
            <input type="text" name="emailSignIn" placeholder="L\'Email">
            <input type="password" name="passwordSignIn" placeholder="Le Mot de Passe">
            <input type="submit" name="submitSignIn">
        </form>
        <p>'.$messageSignIn.'</p>
    </section>;
<?php
    $form = ob_get_clean();
    }
    return '';
}

function displayUser(PDO $bdd) {
    $message = ajouterUtilisateur($bdd);

    $output = generateUsersList($bdd);

    $loginMessage = signIn($bdd);

    $form = displayForm($message,$loginMessage);

    include 'vue/account.php';
}
?>