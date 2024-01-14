<?php
    require './common/header.php';
    require './utils/select.php';

    $id = $_GET['id'];
    
    $recipe = getRecipe($id);
    $recipeDetail = getRecipeDetail($id);
    $category = getCategory($recipe['category_id']);
?>
    <div class="container p-5 card my-2">
        <div class="mb-3 d-flex">
            <p class="fs-1">
                <?php echo $recipe['dish_name'];?>
            </p>
            <a class="btn btn-primary fs-1">
                <?php echo $category['category_name'];?>
            </a>
        </div>
        <div class="row">
            <div class="col col-lg-6">
                <img src=<?php echo $recipe['img_path'];?> alt="料理画像" class="card-img-top rounded-3">
            </div>
            <div class="card-body col col-lg-6">
                <p class="fs-2 fw-bold">材料</p>
                <?php foreach($recipeDetail as $row){ ?>
                    <?php $ingredient = getIngredient($row['ingredient_id']);?>
                    <div class="d-flex justify-content-between">
                        <span class="fs-3">
                            <?php echo $ingredient['ingredient_name'];?>
                        </span>
                        <span class="fs-3">
                            <?php echo $row['quantity'];?>
                        </span>
                    </div>
                    <hr>
                    <?php } ?>
                <p class="fs-2 fw-bold">手順</p>
                <p class="fs-3"><?php echo  $recipe['process'];?></p>
            </div>
        </div>
        <form class="text-muted text-end bg-light p-3" action="./process/secretKeyCheck.php?recipe_id=<?php echo $recipe['id'];?>" method="post">
            <span class="fs-4">秘密の暗号を入力して、編集または削除をする</span>
            <input type="text" name="secret_key">
            <button type="submit">解除！</button>
        </form>
    </div>
<?php
    require './common/footer.php';
?>

<script>
    document.getElementById("backButton").addEventListener("click", function() {
        history.back();
    });
</script>