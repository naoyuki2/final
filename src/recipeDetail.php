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
                        <p class="fs-5 fw-bold">材料 （ <?php echo $recipe['number_of_people'];?> 人分 ）</p>
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
                    </div>
                </div>
                <div class="row">
                    <p class="fs-5 fw-bold">手順</p>
                    <p class="fs-6"><?php echo  $recipe['process'];?></p>
                </div>
                <form class="row rounded bg-light p-3 fs-6" action="./recipeEdit.php" method="post">
                    <div class="col-lg-6 col-12">
                        <span>秘密の暗号を入力して編集または削除</span>
                    </div>
                    <div class="col-lg-6 col-12">
                        <input type="text" name="secret_key">
                        <button type="submit" class="ms-1 btn btn-outline-success btn-sm">解除</button>
                    </div>
                    <input type="hidden" name="recipe_id" value=<?php echo $recipe['id'];?>>
                </form>
            </div>
        </div>
    </div>
<?php
    require './common/footer.php';
?>

