<?php

include 'model/category.php';


function ajouterCategory(PDO $bdd) {
    echo "testest";
     $message = "";
     if(isset($_POST["submit"])) {
        if(!empty($_POST["name"])) {
            $categorie = getCategoryByName($bdd,$_POST["name"]);
            if(!$categorie) {
                 addCategory($bdd, $_POST["name"]);
                $message = "la catégorie a été ajouté";
            }
            else {
                $message = "La catégorie existe déja en BDD";
            } 
        }
    }
   
    include 'vue/addCategory.php';
}

function ListCategory(PDO $bdd) {
    $categories = getAllCategory($bdd);
    $items = ""; // Variable pour stocker les <li>

    // Génération des éléments de la liste
    if (!empty($categories)) {
        ob_start();
        foreach ($categories as $category) {
            ?>
            <li><?= htmlspecialchars($category['name']) ?></li>
            <?php
        }
        $items = ob_get_clean(); // Stocke les <li> dans la variable
    }

    // Génération du HTML complet
    ob_start();
    if (empty($categories)) {
        ?>
        <p>Aucune catégorie trouvée</p>
        <?php
    } else {
        ?>
        <ul>
            <?= $items ?>
        </ul>
        <?php
    }

    return ob_get_clean(); // Retourne le HTML final
}

