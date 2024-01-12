<?php
    require './common/header.php';
    require './utils/select.php';
    $recipe = getRecipeList();
?>
    <div class="container text-center">
        <div class="row">
            <?php foreach($recipe as $row){ ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <a href="recipeDetail.php?id=<?php echo $row['id']; ?>">
                            <img src=<?php echo $row['img_path'];?> class="card-img-top">
                            <div class="card-body">
                                <div><?php echo $row['dish_name'];?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
    require './common/footer.php';
?>