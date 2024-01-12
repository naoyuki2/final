<?php
    require '../utils/delete.php';

    $recipe_id = $_GET['id'];

    deleteRecipeIngredientLink($recipe_id);
    deleteRecipe($recipe_id);

    header('Location: ../top.php');
?>