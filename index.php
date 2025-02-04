<?php
session_start();

//Import des ressources communes
include './vendor/autoload.php';
include './env.php';
include './utils/connexion.php';
include './utils/utils.php';

include 'controller/headerController.php';
include 'controller/categorieController.php';
include 'controller/accountController.php';

$bdd = connexion();

//Parse l'url entrée
$url = parse_url($_SERVER['REQUEST_URI']);

//Je récpuère le path s'il y en a un, sinon je récpère la racine
$path = isset($_GET['path']) ? $_GET['path'] : '/';

// var_dump($path);
// exit;

switch($path){
    //Route pour l'accueil
    case '/':
        // include './controller/categorieController.php';
        // include 'controller/accountController.php';
        renderHeader();
        ajouterCategory($bdd);
        displayUser($bdd);
        break;
    
    //Route pour la page mon compte
    case '/moncompte' :
        include './controller/myAccountController.php';
        renderHeader();
        renderMyAccount();
        break;

    //Route pour la page ajouter une catégorie
    case '/ajoutcategorie' :
        // include './controller/categorieController.php';
        renderHeader();
        ajouterCategory($bdd);
        break;

    //Route pour la page de déconnexion
    case '/deconnexion' :
        include './controller/decoController.php';
        break;

    //Si aucune route ne correspond : Page d'Erreur 404
    default :
        include './controller/errorController.php';
        render404();
}

// renderHeader();
// ajouterCategory($bdd);
// displayUser($bdd);

include 'vue/footer.php';
