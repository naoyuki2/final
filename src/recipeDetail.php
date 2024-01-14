<?php
    require './common/header.php';
    require './utils/select.php';

    $id = $_GET['id'];
    
    $recipe = getRecipe($id);
    $recipeDetail = getRecipeDetail($id);
    $category = getCategory($recipe['category_id']);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 card p-4 my-3">
                <div class="mb-3 fs-4 d-flex justify-content-between">
                    <p>
                        <?php echo $recipe['dish_name'];?>
                    </p>
                    <div>
                        カテゴリ：
                        <a href="./index.php" class="text-muted text-end">
                            <?php echo $category['category_name'];?>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-6">
                        <img src=<?php echo $recipe['img_path'];?> alt="料理画像" class="card-img-top rounded-3">
                    </div>
                    <div class="card-body col col-lg-6">
                        <p class="fs-5 fw-bold">材料</p>
                        <?php foreach($recipeDetail as $row){ ?>
                            <?php $ingredient = getIngredient($row['ingredient_id']);?>
                            <div class="d-flex justify-content-between">
                                <span class="fs-6">
                                    <?php echo $ingredient['ingredient_name'];?>
                                </span>
                                <span class="fs-6">
                                    <?php echo $row['quantity'];?>
                                </span>
                            </div>
                            <hr>
                            <?php } ?>
                        <p class="fs-5 fw-bold">手順</p>
                        <p class="fs-6"><?php echo  $recipe['process'];?></p>
                    </div>
                </div>
                <form class="rounded text-end bg-light p-3" action="./recipeEdit.php" method="post">
                    <input type="hidden" name="recipe_id" value=<?php echo $recipe['id'];?>>
                    <span class="fs-6">秘密の暗号を入力して編集または削除をする</span>
                    <input type="text" name="secret_key">
                    <button type="submit" class="btn btn-outline-success">解除</button>
                </form>
            </div>
        </div>
    </div>
<?php
    require './common/footer.php';
?>

<script>
    document.getElementById("backButton").addEventListener("click", function() {
        history.back();
    });
</script>