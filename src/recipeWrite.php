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
    <form action="./utils/insert.php" method="post">
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
            <input id="text" type="text" name="fruit" value="" autocomplete="off">
            <!-- 補完候補を表示するエリア -->
            <div id="suggest_category"></div>
        </div>
        <div>
            <input name="secret_key" placeholder="秘密の暗号">
        </div>
        <div>
            <input name="ingredient_id" placeholder="材料">
            <input name="quantity" placeholder="分量">
            <input name="unit" placeholder="単位">
        </div>
        <button type="button" id="ingredientPlus"><i class="fa-solid fa-circle-plus"></i> 材料を追加する</button>
        <div>
            <input type="submit" value="投稿する">
        </div>
    </form>
<?php
    require './common/footer.php'
?>

<script>
    const ingredientPlus = document.getElementById('ingredientPlus');
    ingredientPlus.addEventListener('click', () => {
        const ingredient = document.createElement('div');
        ingredient.innerHTML = '<input name="ingredient_id" placeholder="材料"> <input name="quantity" placeholder="分量"> <input name="unit" placeholder="単位">';
        ingredientPlus.before(ingredient);
    });

    const category = <?php echo json_encode($category); ?>;
    new Suggest.Local("text", "suggest_category", category);

    const ingredient = <?php echo json_encode($ingredient); ?>;
    new Suggest.Local("text", "suggest_ingredient", ingredient);

</script>