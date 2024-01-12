<?php
    require 'db-connect.php';
    $pdo = new PDO($connect, USER, PASS);

    function updateSecretKey($recipe_id,$secret_key){
        global $pdo;
        try{
            $stmt = $pdo->prepare("UPDATE recipe SET secret_key = ? where id = ?");
            $stmt->execute([$secret_key,$recipe_id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function updateRecipe($id, $dish_name, $process, $img_path, $category_id){
        global $pdo;
        try{
            $stmt = $pdo->prepare("UPDATE recipe SET dish_name = ?, process = ?, img_path = ?, category_id = ? where id = ?");
            $stmt->execute([$dish_name, $process, $img_path, $category_id, $id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function updateRecipeIngredientLink($recipe_id,$ingredient_id,$quantity){
        global $pdo;
        try{
            $stmt = $pdo->prepare("UPDATE recipe_ingredient_link SET quantity = ? where recipe_id = ? and ingredient_id = ?");
            $stmt->execute([$quantity,$recipe_id,$ingredient_id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }
?>