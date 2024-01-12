<?php
    require './common/header.php';
    require './utils/select.php';

    $id = $_GET['id'];
    
    $recipe = getRecipe($id);
    $recipeDetail = getRecipeDetail($id);
    $category = getCategory($recipe['category_id']);
?>

    <h1>レシピ名：<?php echo $recipe['dish_name'];?></h1>
    <h1>手順：<?php echo $recipe['process'];?></h1>
    <h1>画像：<?php echo $recipe['img_path'];?></h1>
    <h1>カテゴリ：<?php echo  $category['category_name'];?></h1>

    <?php foreach($recipeDetail as $row){ ?>
        <?php $ingredient = getIngredient($row['ingredient_id']);?>
        <h1><?php echo $ingredient['ingredient_name'],":",$row['quantity'];?></h1>
    <?php } ?>
    <form action="./process/secretKeyCheck.php?recipe_id=<?php echo $recipe['id'];?>" method="post">
        <p>秘密の暗号を入力して、編集または削除をする</p>
        <input type="text" name="secret_key">
        <button type="submit">解除！</button>
    </form>
<?php
    require './common/footer.php';
?>

<script>
    document.getElementById("backButton").addEventListener("click", function() {
        history.back();
    });
</script>