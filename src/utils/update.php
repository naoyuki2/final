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
?>