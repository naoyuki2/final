<?php
    require './common/header.php';
    require './utils/select.php';
    $category = getAllCategory();
    $ingredient = getAllIngredient();
?>

    <h1>レシピ投稿</h1>
    <form action="./process/recipeInsert.php" method="post" id="form" enctype="multipart/form-data">
        <div class="container p-5 card my-2">
            <div class="mb-3 d-flex justify-content-between">
                <p class="fs-1">
                    <input name="dish_name" placeholder="レシピのタイトル">
                </p>
                <div class="fs-1">
                    <input id="text_category" type="text" name="category_name" value="" autocomplete="off" placeholder="カテゴリ">
                    <div id="suggest_category"></div>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-6">
                    <div class="bg-light rounded p-5">
                        <img class="card-img-top rounded-3" id="image_preview" src="./img/noimage.jpg" />
                    </div>
                    <input class="form-control card-img-top rounded-3" type="file" name="img_path" id="img_path">
                </div>
                <div class="card-body col col-lg-6">
                    <p class="fs-2 fw-bold">材料</p>

                    <div class="d-flex justify-content-between">
                        <span class="fs-3">
                            <input id="text_ingredient" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="材料">
                            <div id="suggest_ingredient"></div>
                        </span>
                        <span class="fs-3">
                            <input name="quantity[]" placeholder="分量">
                        </span>
                        <span class="fs-3">
                            <input type="button" id="ingredientMinus" value="-">
                        </span>
                    </div>

                    <button type="button" id="ingredientPlus"><i class="fa-solid fa-circle-plus"></i> 材料を追加する</button>
                    <p class="fs-2 fw-bold">手順</p>
                    <textarea class="fs-3" name="process" cols="30" rows="10" placeholder="作り方の手順"></textarea>
                </div>
            </div>
            <div class="text-muted text-end bg-light p-3">
                <button type="submit">投稿する  </button>
            </div>
        </div>
    </form>
<?php
    require './common/footer.php'
?>

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
        ingredient.className = 'd-flex';
        ingredient.innerHTML = `
        <span class="fs-3">
            <input id="text_ingredient${ingredientCount}" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="材料">
            <div id="suggest_ingredient${ingredientCount}"></div>
        </span>
        <span class="fs-3">
            <input name="quantity[]" placeholder="分量">
        </span>
        <span class="fs-3">
            <input type="button" class="ingredientMinus" value="-">
        </span>
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

    document.getElementById("form").onkeypress = (e) => {
    const key = e.keyCode || e.charCode || 0;
        if (key == 13) {
            e.preventDefault();
        }
    }
</script>