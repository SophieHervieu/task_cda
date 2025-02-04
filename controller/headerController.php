<?php
function renderHeader() {
    $nav = '';
    if(isset($_SESSION['id'])) {
        ob_start();
?>
    <a href="/task_cda/moncompte">Mon compte</a>
    <a href="/task_cda/ajoutcategorie">Ajouter une catégorie</a>
    <a href="task_cda/deconnexion">Se déconnecter</a>
<?php

        $nav = ob_get_clean();
    }
    include './vue/header.php';
}