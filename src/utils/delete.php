<?php
    require 'db-connect.php';
    $pdo = new PDO($connect, USER, PASS);

    function deleteRecipeIngredientLinkAll($recipe_id){
        global $pdo;
        try{
            $stmt = $pdo->prepare("DELETE FROM recipe_ingredient_link WHERE recipe_id = ?");
            $stmt->execute([$recipe_id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function deleteRecipe($recipe_id){
        global $pdo;
        try{
            $stmt = $pdo->prepare("DELETE FROM recipe WHERE id = ?");
            $stmt->execute([$recipe_id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function deleteRecipeIngredientLink($recipe_id,$ingredient_id){
        global $pdo;
        try{
            $stmt = $pdo->prepare("DELETE FROM recipe_ingredient_link WHERE recipe_id = ? and ingredient_id = ?");
            $stmt->execute([$recipe_id,$ingredient_id]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }
?>