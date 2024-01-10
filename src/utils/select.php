<?php
    require 'db-connect.php';
    $pdo = new PDO($connect, USER, PASS);
    
    function getRecipeList(){
        global $pdo;
        try{
            $sql = $pdo->query('select * from recipe');
            return $sql;
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getRecipe($id){
        global $pdo;
        try{
            $sql = $pdo->prepare('select * from recipe where id = ?');
            $sql->execute([$id]);
            return $sql->fetch();
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getRecipeDetail($id){
        global $pdo;
        try{
            $sql = $pdo->prepare('
            select * from recipe_ingredient_link where recipe_id = ?');
            $sql->execute([$id]);
            return $sql;
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getCategory($id){
        global $pdo;
        try{
            $sql = $pdo->prepare('select * from category where id = ?');
            $sql->execute([$id]);
            return $sql->fetch();
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getIngredient($id){
        global $pdo;
        try{
            $sql = $pdo->prepare('select * from ingredient where id = ?');
            $sql->execute([$id]);
            return $sql->fetch();
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getAllCategory(){
        global $pdo;
        try{
            $sql = $pdo->query('select category_name from category');
            $category = [];
            foreach($sql as $row){
                $category[] = $row['category_name'];
            }
            return $category;
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }

    function getAllIngredient(){
        global $pdo;
        try{
            $sql = $pdo->query('select ingredient_name from ingredient');
            $ingredient = [];
            foreach($sql as $row){
                $ingredient[] = $row['ingredient_name'];
            }
            return $ingredient;
        }catch(PDOException $e){
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }
?>