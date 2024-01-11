<?php
    require './common/header.php';

    $dish_name = $_POST['dish_name'];
    echo '<h1>'.$dish_name.'</h1>';

    $process = $_POST['process'];
    echo '<p>'.$process.'</p>';

    $img_path = $_POST['img_path'];
    echo '<p>'.$img_path.'</p>';
    if(empty($img_path)){
        // echo '<img src="./img/default.jpg">';
        echo '<h1>./img/default.jpg</h1>';
    }else{
        echo '<img src="'.$img_path.'">';
    }

    $category_name = $_POST['category_name'];
    echo '<p>'.$category_name.'</p>';

    $ingredient_name = $_POST['ingredient_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    array_map(function($i, $q, $u) {
        echo '<p>材料名: '.$i.', 分量: '.$q.', 単位: '.$u.'</p>';
    }, $ingredient_name, $quantity, $unit);

    require './common/footer.php';
?>