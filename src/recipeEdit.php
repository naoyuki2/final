<?php
    require './common/header.php';
    require './utils/select.php';
    require './utils/update.php';
    require './utils/delete.php';
    $category = getAllCategory();
    $ingredient = getAllIngredient();
    $recipe_id = $_GET['id'];
    // echo '<pre>';
    // var_dump($category);
    // echo '</pre>';
?>
    <?php
        echo '<a href="./process/recipeDelete.php?id=',$recipe_id,'">';
            echo '<button>削除</button>';
        echo '</a>';
    ?>
    <h1>レシピ編集</h1>
    <form action="./process/recipeInsert.php" method="post" id="form" enctype="multipart/form-data">
        <div>
            <input name="dish_name" placeholder="レシピのタイトル">
        </div>
        <div>
            <textarea name="process" cols="30" rows="10" placeholder="作り方の手順"></textarea>
        </div>
        <div>
            <input class="form-control" type="file" name="img_path" id="img_path">
        </div>
        <div>
            <input id="text_category" type="text" name="category_name" value="" autocomplete="off" placeholder="カテゴリ">
            <!-- 補完候補を表示するエリア -->
            <div id="suggest_category"></div>
        </div>
        <!-- <div>
            <input name="secret_key" placeholder="秘密の暗号">
        </div> -->
        <div class="d-flex flex-row">
            <input id="text_ingredient" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="材料">
            <div id="suggest_ingredient"></div>
            <input name="quantity[]" placeholder="分量">
            <input name="unit[]" placeholder="単位">
        </div>
        <button type="button" id="ingredientPlus"><i class="fa-solid fa-circle-plus"></i> 材料を追加する</button>
        <div>
            <input type="submit" value="投稿する">
        </div>
        <img id="image_preview" src="#" alt="Image Preview" />
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
        ingredient.innerHTML = `<input id="text_ingredient${ingredientCount}" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="材料"><div id="suggest_ingredient${ingredientCount}"></div> <input name="quantity[]" placeholder="分量"> <input name="unit[]" placeholder="単位">`;
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