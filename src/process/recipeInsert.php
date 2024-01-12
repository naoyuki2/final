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
        $img_path = './img/default.jpg';
    }

    require '../utils/insert.php';
    require '../utils/select.php';

    postCategory($_POST['category_name']);

    foreach($_POST['ingredient_name'] as $ingredient){
        postIngredient($ingredient);
    }

    $category_id = getCategoryId($_POST['category_name']);
    // echo $category_id['id']; 

    postRecipe($_POST['dish_name'], $_POST['process'], $img_path, $category_id['id']);

    $recipe_id = getRecipeId($_POST['dish_name']);

    array_map(function($i, $q) {
        global $recipe_id;
        $ingredient_id = getIngredientId($i);
        if(!($q === '' || $i === '')){
            postRecipeIngredientLink($recipe_id['id'], $ingredient_id['id'], $q);
        }
    }, $_POST['ingredient_name'], $_POST['quantity']);

    header('Location: ../recipeComp.php?recipe_id=' . $recipe_id['id'] . '');
?>
