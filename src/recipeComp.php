<?php
    require './common/header.php';
    $recipe_id = $_GET['recipe_id'];
    $mode = $_GET['mode'];//update or insert or secret or delete
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
                                echo './img/check_mark_purple.svg';
                            }else if($mode === 'update'){
                                echo './img/check_mark_blue.svg';
                            }else if($mode === 'insert'){
                                echo './img/check_mark_green.svg';
                            }else{
                                echo './img/check_mark_red.svg';
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
                                }else if($mode === 'insert'){
                                    echo 'レシピの投稿が完了しました！';
                                    echo '<hr>';
                                }else{
                                    echo 'レシピの削除が完了しました！';
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
                        <?php if($mode !== 'delete'){ ?>
                        <div class="col">
                            <a href="./recipeDetail.php?id=<?php echo $recipe_id;?>" class="btn btn-outline-success">
                                <?php
                                    if($mode === 'update'){
                                        echo '編集したレシピを見に行く！';
                                    }else if($mode === 'insert' || $mode === 'secret'){
                                        echo '投稿したレシピを見に行く！';
                                    }
                                ?>
                            </a>
                        </div>
                        <?php } ?>
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

<script>
    document.getElementById("form").onkeypress = (e) => {
    const key = e.keyCode || e.charCode || 0;
        if (key == 13) {
            e.preventDefault();
        }
    }
</script>

<?php require './common/footer.php'; ?>