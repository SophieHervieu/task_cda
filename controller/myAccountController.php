<?php

function renderMyAccount() {
//Vérifier la superglobal SESSION
    if(!isset($_SESSION['id'])){
        //On redirige si personne n'est connecté
        header('location:/task_cda/');
        exit;
    }
    include './vue/viewMyAccount.php';
}

?>