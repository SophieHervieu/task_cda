<?php
//Activer ma session
session_start();

include 'controller/headerController.php';
include 'controller/myAccountController.php';
include 'vue/footer.php';

renderHeader();
renderMyAccount();