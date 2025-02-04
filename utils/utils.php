<?php
/*@method nettoyage de chaînes de caractères pour enlever les balises HTML et PHP, les espaces vides en début et fin de chaîne
*@param string $data
*@return string
*/
function sanitize($data) {
    return htmlentities(strip_tags(stripslashes(trim($data))));
}