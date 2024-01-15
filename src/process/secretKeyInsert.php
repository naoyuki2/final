<?php
    require '../utils/update.php';

    $recipe_id = $_GET['recipe_id'];
    $secret_key = $_POST['secret_key'];

    updateSecretKey($recipe_id,$secret_key);

    header('Location: ../recipeComp.php?recipe_id='.$recipe_id.'&mode=secret');

?>