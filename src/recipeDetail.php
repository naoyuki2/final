<?php
    require './common/header.php';
    require './utils/select.php';

    $id = $_GET['id'];
    
    $recipe = getRecipe($id);
    $recipeDetail = getRecipeDetail($id);
    $category = getCategory($recipe['category_id']);

    // echo '<h1>レシピNo.',$recipe['id'],'</h1>';
    echo '<h1>レシピ名：',$recipe['dish_name'],'</h1>';
    echo '<h1>手順：',$recipe['process'],'</h1>';
    echo '<h1>画像：',$recipe['img_path'],'</h1>';
    // echo '<h1>秘密の暗号：',$recipe['secret_key'],'</h1>';
    // echo '<h1>カテゴリID：',$recipe['category_id'],'</h1>';
    echo '<h1>カテゴリ：',$category['category_name'],'</h1>';

    foreach($recipeDetail as $row){
        $ingredient = getIngredient($row['ingredient_id']);
        // echo '<h1>材料ID：',$row['ingredient_id'],'</h1>';
        echo '<h1>',$ingredient['ingredient_name'],'：',$row['quantity'],'</h1>';
    }
    echo '<form action="./process/secretKeyCheck.php?recipe_id=',$recipe['id'],'" method="post">';
        echo '<p>秘密の暗号を入力して、編集または削除をする</p>';
        echo '<input type="text" name="secret_key">';
        echo '<button type="submit">解除！</button>';
    echo '</form>';

    require './common/footer.php';
?>

<script>
    document.getElementById("backButton").addEventListener("click", function() {
        history.back();
    });
</script>