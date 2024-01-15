<?php
    require './common/header.php';
    require './utils/select.php';
    require './utils/update.php';

    $recipe_id = $_POST['recipe_id'];
    $secret_key = $_POST['secret_key'];

    $recipe = getRecipe($recipe_id);

    if($secret_key !== $recipe['secret_key']){
        echo '<script> history.back(); </script>';
    }
    
    $category = getAllCategory();
    $ingredient = getAllIngredient();

    $recipe = getRecipe($recipe_id);
    $recipeDetail = getRecipeDetail($recipe_id);
    $category = getCategory($recipe['category_id']);
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card p-4 my-3">
                        <div class="row d-flex">
                            <p class="col fs-4 fw-bold">レシピを編集・削除する</p>
                            <div class="col-1">
                                <form class="d-flex justify-content-end" action="./process/recipeDelete.php" method="post">
                                    <input type="submit" class="btn btn-outline-danger w-auto h-auto" value="削除"/>
                                    <input type="hidden" name="id" value=<?php echo $recipe_id;?>>
                                </form>
                            </div>
                            <hr>
                        </div>
                        <form action="./process/recipeUpdate.php?id=<?php echo $recipe_id; ?>" method="post" id="form" enctype="multipart/form-data">
                        <div class="row d-flex flex-column flex-lg-row">
                            <div class="col">
                                <p class="fs-5 fw-bold">レシピのタイトル</p>
                                <p class="fs-5">
                                <input class="w-100" name="dish_name" value=<?php echo $recipe['dish_name'];?> placeholder="例：ペペロンチーノ">
                                </p>
                            </div>
                            <div class="col">
                                <p class="fs-5 fw-bold">カテゴリ</p>
                                <p class="fs-5">
                                    <input class="w-100" id="text_category" type="text" name="category_name" value=<?php echo $category['category_name']; ?> autocomplete="off" placeholder="例：パスタ">
                                    <div id="suggest_category"></div>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-6">
                                <div class="bg-light rounded p-5">
                                    <img class="card-img-top rounded-3" id="image_preview" src=<?php echo $recipe['img_path'];?> />
                                </div>
                                <input class="mt-3 form-control card-img-top rounded-3" type="file" name="img_path" id="img_path">
                                <input type="hidden" name="img_path" value="<?php echo $recipe['img_path'];?>">
                            </div>
                            <div class="card-body col col-lg-6">
                                <p class="col fs-5 fw-bold">材料</p>
                                <div class="row text-center fs-6">
                                    <p class="me-1 col bg-light p-1 rounded">材料・調味料</p>
                                    <p class="col bg-light p-1 rounded">分量</p>
                                    <p class="col-1"></p>
                                </div>
                                <?php foreach($recipeDetail as $row){ ?>
                                    <?php $ingredient = getIngredient($row['ingredient_id']);?>
                                    <div class="row fs-6 mb-1">
                                        <input class="col" id="text_ingredient" type="text" name="ingredient_name[]" value=<?php echo $ingredient['ingredient_name'];?> autocomplete="off" placeholder="例）豚肉">
                                        <p id="suggest_ingredient"></p>
                                        <input class="mx-1 col" name="quantity[]" placeholder="例）350g" value=<?php echo $row['quantity'];?>>
                                        <div class="col-1">
                                            <i class="ingredientMinus fa-regular fa-circle-xmark fa-lg" role="button" id="ingredientMinus"></i>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row w-auto" id="ingredientPlus">
                                    <p class="w-auto fs-6 mt-1" type="button"> + 行を追加する</p>
                                </div>
                                <p class="fs-5 fw-bold">手順</p>
                                <textarea class="fs-6 w-100" name="process" placeholder="作り方の手順"><?php echo $recipe['process'];?></textarea>
                                <div class="row pt-3 justify-content-center">
                                    <button class="col-6 btn btn-outline-success" type="submit">編集を完了する</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php require './common/footer.php'; ?>

<script>
    const category = <?php echo json_encode($category); ?>;
    new Suggest.Local("text_category", "suggest_category", category);
    
    const ingredientList = <?php echo json_encode($ingredient); ?>;
    new Suggest.Local("text_ingredient", "suggest_ingredient", ingredientList);
    
    let ingredientCount = 0;

    const ingredientPlus = document.getElementById('ingredientPlus');
    ingredientPlus.addEventListener('click', () => {
        ingredientCount++;
        const ingredient = document.createElement('div');
        ingredient.className = 'row fs-6 mb-1';
        ingredient.innerHTML = `
            <input class="col" id="text_ingredient${ingredientCount}" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="">
            <div id="suggest_ingredient${ingredientCount}"></div>
            <input class="mx-1 col" name="quantity[]" placeholder="">
            <div class="col-1">
                <i class="ingredientMinus fa-regular fa-circle-xmark fa-lg" id="ingredientMinus"></i>
            </div>
        `;
        ingredientPlus.before(ingredient);
        new Suggest.Local(`text_ingredient${ingredientCount}`, `suggest_ingredient${ingredientCount}`, ingredientList);
    });

    document.addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('ingredientMinus')) {
            e.target.parentNode.parentNode.remove();
        }
    });

    document.getElementById("form").onkeypress = (e) => {
    const key = e.keyCode || e.charCode || 0;
        if (key == 13) {
            e.preventDefault();
        }
    }

    document.getElementById("backButton").addEventListener("click", function() {
        history.back();
    });

    document.getElementById("form").addEventListener("submit", function(event){
        let inputs = this.getElementsByTagName('input');
        let img_path = document.getElementById('img_path'); // nullを許可するinput要素
        for(let i = 0; i < inputs.length; i++) {
            if(inputs[i].value == '' && inputs[i] !== img_path) {
                alert('画像以外のすべてのフィールドを入力してください');
                event.preventDefault();
                return false;
            }
        }
    });

    document.getElementById('img_path').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image_preview').src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

</script>