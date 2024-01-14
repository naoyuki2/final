<?php
    require '../utils/select.php';

    $recipe_id = $_POST['recipe_id'];
    $secret_key = $_POST['secret_key'];

    $recipe = getRecipe($recipe_id);

    if($secret_key === $recipe['secret_key']){
        header('Location: ../recipeEdit.php?id='.$recipe_id);
    }else{
        echo '<script> history.back(); </script>';
    }
?>