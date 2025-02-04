<?php
function render404(){
    $error = "";
    ob_start();
?>
    <h1>Error 404 Not found !</h1>;
<?php
    $error = ob_get_clean();
    include './vue/error.php';
}