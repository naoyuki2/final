<?php
    require '../utils/delete.php';

    $recipe_id = $_POST['id'];

    deleteRecipeIngredientLinkAll($recipe_id);
    deleteRecipe($recipe_id);

    header('Location: ../recipeComp.php?recipe_id='.$recipe_id.'&mode=delete');
?>