<?php
    require './common/header.php';
    require './common/db-connect.php';

    // echo '<img src="./img/default.jpg" alt="default">';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->query('select * from recipe');
    foreach($sql as $row){
        echo '<a href="recipeDetail.php?id='.$row['id'].'">';
        echo '<img src=',$row['img_path'],' alt="dish_img">';
        echo '<div>',$row['dish_name'],'</div>';
        echo '</a>';
    }

    require './common/footer.php';
?>