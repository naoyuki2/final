<?php
    require '../utils/update.php';

    $recipe_id = $_GET['recipe_id'];
    $secret_key = $_POST['secret_key'];

    updateSecretKey($recipe_id,$secret_key);

?>