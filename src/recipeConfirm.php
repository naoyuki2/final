<?php
    require './common/header.php';

    $dish_name = $_POST['dish_name'];
    echo '<h1>'.$dish_name.'</h1>';

    $process = $_POST['process'];
    echo '<p>'.$process.'</p>';

    $img_path = $_POST['img_path'];
    echo '<p>'.$img_path.'</p>';
    if(empty($img_path)){
        echo '<img src="./img/default.jpg">';
    }else{
        echo '<img src="'.$img_path.'">';
    }

    $category_name = $_POST['category_name'];
    echo '<p>'.$category_name.'</p>';

    $ingredient_name = $_POST['ingredient_name'];
    echo '<p>'.$ingredient_name.'</p>';

    $quantity = $_POST['quantity'];
    echo '<p>'.$quantity.'</p>';

    $unit = $_POST['unit'];
    echo '<p>'.$unit.'</p>';

    require './common/footer.php';
?>