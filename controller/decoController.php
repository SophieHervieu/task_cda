<?php
//Activer ma session
session_start();

//détruire la session
session_destroy();

//Rédiriger vers la page d'accueil
header('location:/');
exit;
?>