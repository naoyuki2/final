<?php
    require './common/header.php';
    require './utils/select.php';
    $category = getAllCategory();
    $ingredient = getAllIngredient();
?>

    <form action="./process/recipeInsert.php" method="post" id="form" enctype="multipart/form-data">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card p-4 my-3">
                        <div class="row">
                            <p class="col fs-4 fw-bold">レシピを書く</p>
                            <hr>
                        </div>
                        <div class="row d-flex flex-column flex-lg-row">
                            <div class="col">
                                <p class="fs-5 fw-bold">レシピのタイトル</p>
                                <p class="fs-5">
                                <input class="w-100" name="dish_name" placeholder="例：ペペロンチーノ">
                                </p>
                            </div>
                            <div class="col">
                                <p class="fs-5 fw-bold">カテゴリ</p>
                                <p class="fs-5">
                                    <input class="w-100" id="text_category" type="text" name="category_name" value="" autocomplete="off" placeholder="例：パスタ">
                                    <div id="suggest_category"></div>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-6">
                                <div class="bg-light rounded p-5">
                                    <img class="card-img-top rounded-3" id="image_preview" src="./img/noimage.jpg" />
                                </div>
                                <input class="mt-3 form-control card-img-top rounded-3" type="file" name="img_path" id="img_path">
                            </div>
                        <div class="card-body col col-lg-6">
                            <p class="col fs-5 fw-bold">材料</p>
                            <div class="row text-center fs-6">
                                <p class="me-1 col bg-light p-1 rounded">材料・調味料</p>
                                <p class="col bg-light p-1 rounded">分量</p>
                                <p class="col-1"></p>
                            </div>
                            <div class="row fs-6 mb-1">
                                <input class="col" id="text_ingredient" type="text" name="ingredient_name[]" value="" autocomplete="off" placeholder="例）豚肉">
                                <p id="suggest_ingredient"></p>
                                <input class="mx-1 col text-muted" name="quantity[]" placeholder="例）350g">
                                <div class="col-1">
                                    <i class="ingredientMinus fa-regular fa-circle-xmark fa-lg" role="button" id="ingredientMinus"></i>
                                </div>
                            </div>
                            <div class="row w-auto" id="ingredientPlus">
                                <p class="w-auto fs-6 mt-1" type="button"> + 行を追加する</p>
                            </div>
                            <p class="fs-5 fw-bold">手順</p>
                            <textarea class="fs-6 w-100" name="process" placeholder="作り方の手順"></textarea>
                            <div class="row pt-3 justify-content-center">
                                <button class="col-6 btn btn-outline-success" type="submit">投稿する  </button>
                            </div>
                        </div>
                    </div>
                </div>
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
        for(let i = 0; i < inputs.length; i++) {
            if(inputs[i].value == '') {
                alert('すべてのフィールドを入力してください');
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

    document.getElementById("form").onkeypress = (e) => {
    const key = e.keyCode || e.charCode || 0;
        if (key == 13) {
            e.preventDefault();
        }
    }
</script>