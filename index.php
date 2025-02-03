<?php

include './vendor/autoload.php';
include './env.php';
include './utils/connexion.php';

include 'controller/categorieController.php';
include 'controller/accountController.php';

include 'vue/header.php';

$bdd = connexion();
ajouterCategory($bdd);
displayUser($bdd);

include 'vue/footer.php';
