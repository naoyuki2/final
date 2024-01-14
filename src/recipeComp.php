<?php
    require './common/header.php';
    $recipe_id = $_GET['recipe_id'];
?>

<form action="./process/secretKeyInsert.php?recipe_id=<?php echo $recipe_id;?>" method="post">
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 my-3">
                <div class="row mb-3">
                    <p class="fs-4 col">投稿が完了しました！</p>
                    <hr>
                </div>
                <div class="row mb-3">
                    <p class="fs-5 col">
                        レシピを編集・削除する場合のために秘密の暗号を設定しませんか？
                    </p>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input name="secret_key" placeholder="秘密の暗号">
                        <button type=submit >設定する</button>
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <div class="col">
                        <a href="./recipeDetail.php?id=<?php echo $recipe_id;?>" class="btn btn-outline-success">
                            投稿したレシピを見に行く！
                        </a>
                    </div>
                    <div class="col">
                        <a href="./top.php" class="btn btn-outline-primary">
                            　　トップページに戻る　　
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './common/footer.php'; ?>