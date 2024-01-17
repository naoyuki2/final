<?php
    require 'db-connect.php';
    $pdo = new PDO($connect, USER, PASS);

    function postCategory($category_name){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM category WHERE category_name = ?");
            $stmt->execute([$category_name]);
            $count = $stmt->fetchColumn();
            if ($count == 0) {
                // カテゴリが存在しない場合、新しいカテゴリを追加
                $stmt = $pdo->prepare("INSERT INTO category (category_name) VALUES (?)");
                $stmt->execute([$category_name]);
            }
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function postIngredient($ingredient_name){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ingredient WHERE ingredient_name = ?");
            $stmt->execute([$ingredient_name]);
            $count = $stmt->fetchColumn();
            if ($count == 0) {
                // 材料が存在しない場合、新しい材料を追加
                $stmt = $pdo->prepare("INSERT INTO ingredient (ingredient_name) VALUES (?)");
                $stmt->execute([$ingredient_name]);
            }
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function postRecipe($dish_name,$process,$img_path,$category_id,$number_of_people){
        global $pdo;
        try{
            $stmt = $pdo->prepare("INSERT INTO recipe (dish_name,process,img_path,category_id,number_of_people) VALUES (?,?,?,?,?)");
            $stmt->execute([$dish_name,$process,$img_path,$category_id,$number_of_people]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function postRecipeIngredientLink($recipe_id,$ingredient_id,$quantity,){
        global $pdo;
        try{
            $stmt = $pdo->prepare("INSERT INTO recipe_ingredient_link (recipe_id,ingredient_id,quantity) VALUES (?,?,?)");
            $stmt->execute([$recipe_id,$ingredient_id,$quantity]);
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }
?>