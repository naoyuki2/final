<?php
    require './common/header.php';
    require './utils/select.php';
    $category = getAllCategory();
    $ingredient = getAllIngredient();
    // echo '<pre>';
    // var_dump($category);
    // echo '</pre>';
?>

    <h1>レシピ投稿</h1>
    <form action="recipeConfirm.php" method="post" id="form">
        <div>
            <input name="dish_name" placeholder="レシピのタイトル">
        </div>
        <div>
            <textarea name="process" cols="30" rows="10" placeholder="作り方の手順"></textarea>
        </div>
        <div>
            <input name="img_path" placeholder="画像選択">
        </div>
        <div>
            <input id="text_category" type="text" name="category_name" value="" autocomplete="off" placeholder="カテゴリ">
            <!-- 補完候補を表示するエリア -->
            <div id="suggest_category"></div>
        </div>
        <div>
            <input name="secret_key" placeholder="秘密の暗号">
        </div>
        <div class="d-flex flex-row">
            <input id="text_ingredient" type="text" name="ingredient_name" value="" autocomplete="off" placeholder="材料">
            <div id="suggest_ingredient"></div>
            <input name="quantity" placeholder="分量">
            <input name="unit" placeholder="単位">
        </div>
        <button type="button" id="ingredientPlus"><i class="fa-solid fa-circle-plus"></i> 材料を追加する</button>
        <div>
            <input type="submit" value="投稿内容を確認する">
        </div>
    </form>
<?php
    require './common/footer.php'
?>

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
        ingredient.innerHTML = `<input id="text_ingredient${ingredientCount}" type="text" name="ingredient_name" value="" autocomplete="off" placeholder="材料"><div id="suggest_ingredient${ingredientCount}"></div> <input name="quantity" placeholder="分量"> <input name="unit" placeholder="単位">`;
        ingredientPlus.before(ingredient);
        new Suggest.Local(`text_ingredient${ingredientCount}`, `suggest_ingredient${ingredientCount}`, ingredientList);
    });

    document.getElementById("form").onkeypress = (e) => {
    const key = e.keyCode || e.charCode || 0;
        if (key == 13) {
            e.preventDefault();
        }
    }

</script>