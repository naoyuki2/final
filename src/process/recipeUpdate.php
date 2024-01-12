<?php
    $uploaded_file = $_FILES['img_path'];
    if(!empty($uploaded_file['name'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // ファイルがアップロードされていることを確認
            if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] == 0) {
                $uploaded_file = $_FILES['img_path'];

                // ファイルの拡張子を確認
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
                if (in_array($file_extension, $allowed_extensions)) {
                    // 保存先のパスを指定
                    $destination = '../../uploads/' . $uploaded_file['name'];
                    $img_path = mb_substr($destination, 3);

                    // ファイルを指定した場所に移動      
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

    // 現在のレシピの材料名をすべて取得
    $current_ingredients = getRecipeAllIngredient($recipe_id);
    $current_ingredients_name = [];
    foreach($current_ingredients as $ingredient){
        $current_ingredients_name[] = $ingredient['ingredient_name'];
    }

    foreach($_POST['ingredient_name'] as $key => $ingredient){
        $quantity = $_POST['quantity'][$key];
        // echo $ingredient;みそ
        // echo $quantity;10

        // If the ingredient is empty, continue to the next one
        if($ingredient === '' || $quantity === ''){
            continue;
        }

        // If the ingredient is not in the current ingredients, add it
        if(!in_array($ingredient, $current_ingredients_name)){
            echo '入ってない';
            postIngredient($ingredient);
            $ingredient_id = getIngredientId($ingredient);
            postRecipeIngredientLink($recipe_id, $ingredient_id['id'], $quantity);
        } else {
            echo '入ってる';
            // If the ingredient is in the current ingredients, update it
            $ingredient_id = getIngredientId($ingredient);
            updateRecipeIngredientLink($recipe_id, $ingredient_id['id'], $quantity);
        }
    }

    // // Remove any ingredients that are no longer present
    foreach($current_ingredients_name as $ingredient){
        if(!in_array($ingredient, $_POST['ingredient_name'])){
            echo '消す',$ingredient;
            $ingredient_id = getIngredientId($ingredient);
            deleteRecipeIngredientLink($recipe_id, $ingredient_id['id']);
        }
    }

    header('Location: ../top.php');

    // array_map(function($i, $q) {
    //     global $recipe_id;
    //     $ingredient_id = getIngredientId($i);
    //     if(!($q === '' || $i === '')){
    //         postRecipeIngredientLink($recipe_id['id'], $ingredient_id['id'], $q);
    //     }
    // }, $_POST['ingredient_name'], $_POST['quantity']);

    // header('Location: ../recipeComp.php?recipe_id=' . $recipe_id['id'] . '');
?>
