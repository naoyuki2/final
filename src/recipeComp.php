<?php
    require './common/header.php';
    $recipe_id = $_GET['recipe_id'];
    $mode = $_GET['mode'];//update or insert
?>

<form action="./process/secretKeyInsert.php?recipe_id=<?php echo $recipe_id;?>" method="post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4 my-3">
                    <div class="row justify-content-center">
                        <img src=
                        <?php
                            if($mode === 'secret'){
                                echo './img/check_mark_red.svg';
                            }else if($mode === 'update'){
                                echo './img/check_mark_blue.svg';
                            }else{
                                echo './img/check_mark_green.svg';
                            }
                        ?>
                        class="check" alt="">
                    </div>
                    <div class="row mb-3">
                        <p class="fs-4 col">
                            <?php
                                if($mode === 'secret'){
                                    echo '秘密の暗号を設定しました！';
                                }else if($mode === 'update'){
                                    echo 'レシピの編集が完了しました！';
                                }else{
                                    echo 'レシピの投稿が完了しました！';
                                    echo '<hr>';
                                }
                            ?>
                        </p>
                    </div>
                    <?php if($mode === 'insert'){ ?>
                    <div class="row mb-3">
                        <p class="fs-5 col">
                            レシピを編集・削除する場合のために秘密の暗号を設定しませんか？
                        </p>
                    </div>
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-end">
                            <input name="secret_key" placeholder="秘密の暗号">
                            <button class="btn btn-outline-secondary btn-sm" type=submit >設定する</button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <hr>
                        <div class="col">
                            <a href="./recipeDetail.php?id=<?php echo $recipe_id;?>" class="btn btn-outline-success">
                                <?php
                                    if($mode === 'update'){
                                        echo '編集したレシピを見に行く！';
                                    }else{
                                        echo '投稿したレシピを見に行く！';
                                    }
                                ?>
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
</form>

<?php require './common/footer.php'; ?>