<?php
    require '../utils/delete.php';

    $recipe_id = $_POST['id'];

    deleteRecipeIngredientLinkAll($recipe_id);
    deleteRecipe($recipe_id);

    header('Location: ../top.php');
?>