<?php
    $uploaded_file = $_FILES['img_path'];
    if(!empty($uploaded_file['name'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] == 0) {
                $uploaded_file = $_FILES['img_path'];

                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
                if (in_array($file_extension, $allowed_extensions)) {
                    $destination = '../../uploads/' . $uploaded_file['name'];
                    $img_path = mb_substr($destination, 3);

                    if (move_uploaded_file($uploaded_file['tmp_name'], $destination)) {
                        $_SESSION['insertMessage'] = "File uploaded successfully.";
                    } else {
                        $_SESSION['insertMessage'] = "Failed to upload file.";
                        header('Location: recipeWrite.php');
                    }
                } else {
                    $_SESSION['insertMessage'] = "Invalid file extension.";
                    header('Location: recipeWrite.php');
                }
            } else {
                $_SESSION['insertMessage'] = "No file uploaded.";
                header('Location: recipeWrite.php');
            }
        }
    }else{
        $img_path = $_POST['img_path'];
    }

    require '../utils/insert.php';
    require '../utils/select.php';
    require '../utils/update.php';
    require '../utils/delete.php';

    $recipe_id = $_GET['id'];

    postCategory($_POST['category_name']);
    $category_id = getCategoryId($_POST['category_name']);

    updateRecipe($recipe_id, $_POST['dish_name'], $_POST['process'], $img_path, $category_id['id']);

    $current_ingredients = getRecipeAllIngredient($recipe_id);
    $current_ingredients_name = [];
    foreach($current_ingredients as $ingredient){
        $current_ingredients_name[] = $ingredient['ingredient_name'];
    }

    foreach($_POST['ingredient_name'] as $key => $ingredient){
        $quantity = $_POST['quantity'][$key];

        if($ingredient === '' || $quantity === ''){
            continue;
        }

        if(!in_array($ingredient, $current_ingredients_name)){
            postIngredient($ingredient);
            $ingredient_id = getIngredientId($ingredient);
            postRecipeIngredientLink($recipe_id, $ingredient_id['id'], $quantity);
        } else {
            $ingredient_id = getIngredientId($ingredient);
            updateRecipeIngredientLink($recipe_id, $ingredient_id['id'], $quantity);
        }
    }

    foreach($current_ingredients_name as $ingredient){
        if(!in_array($ingredient, $_POST['ingredient_name'])){
            echo '消す',$ingredient;
            $ingredient_id = getIngredientId($ingredient);
            deleteRecipeIngredientLink($recipe_id, $ingredient_id['id']);
        }
    }

    header('Location: ../top.php');
?>
