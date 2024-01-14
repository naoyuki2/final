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
    <a href="./process/recipeDelete.php?id=<?php echo $recipe_id;?>">
        <button>削除</button>
    </a>
    <h1>レシピ編集</h1>
    <form action="./process/recipeUpdate.php?id=<?php echo $recipe_id; ?>" method="post" id="form" enctype="multipart/form-data">
        <div>
            <input name="dish_name" placeholder="レシピのタイトル" value=<?php echo $recipe['dish_name'];?>>
        </div>
        <div>
            <textarea name="process" cols="30" rows="10" placeholder="作り方の手順"><?php echo $recipe['process'];?></textarea>
        </div>
        <div>
            <input class="form-control" type="file" name="img_path" id="img_path">
            <input type="hidden" name="img_path" value="<?php echo $recipe['img_path'];?>">
        </div>
        <div>
            <input id="text_category" type="text" name="category_name" value="<?php echo $category['category_name']; ?> " autocomplete="off" placeholder="カテゴリ">
            <div id="suggest_category"></div>
        </div>
        <?php foreach($recipeDetail as $row){ ?>
                <?php $ingredient = getIngredient($row['ingredient_id']);?>
                <div class="d-flex flex-row">
                    <input id="text_ingredient" type="text" name="ingredient_name[]" value=<?php echo $ingredient['ingredient_name'];?> autocomplete="off" placeholder="材料">
                    <div id="suggest_ingredient"></div>
                    <input name="quantity[]" placeholder="分量" value=<?php echo $row['quantity'];?>>
                </div>
        <?php } ?>
        <button type="button" id="ingredientPlus"><i class="fa-solid fa-circle-plus"></i> 材料を追加する</button>
        <div>
            <input type="submit" value="投稿する">
        </div>
        <img id="image_preview" alt="Image Preview" src=<?php echo $recipe['img_path'];?> />
    </form>
<?php require './common/footer.php'; ?>

<script>
    let ingredientCount = 0;

    const category = <?php echo json_encode($category); ?>;
    new Suggest.Local("text_category", "suggest_category", category);

    const ingredientList = <?php echo json_encode($ingredient); ?>;
    new Suggest.Local("text_ingredient", "suggest_ingredient", ingredientList);

    const ingredientPlus = document.getElementById('ingredientPlus');
    ingredientPlus.addEventListener('click', () => {
        ingredientCount++;
        const ingredient = document.createElement('div');
        ingredient.className = 'd-flex flex-row';
        ingredient.innerHTML = `<input id="text_ingredient${ingredientCount}" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="材料"><div id="suggest_ingredient${ingredientCount}"></div> <input name="quantity[]" placeholder="分量">`;
        ingredientPlus.before(ingredient);
        new Suggest.Local(`text_ingredient${ingredientCount}`, `suggest_ingredient${ingredientCount}`, ingredientList);
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

    // document.getElementById("form").addEventListener("submit", function(event){
    //     let inputs = this.getElementsByTagName('input');
    //     for(let i = 0; i < inputs.length; i++) {
    //         if(inputs[i].value == '') {
    //             alert('すべてのフィールドを入力してください');
    //             event.preventDefault();
    //             return false;
    //         }
    //     }
    // });

    document.getElementById('img_path').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image_preview').src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

</script>