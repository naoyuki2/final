<?php
    require './common/header.php';
    require './utils/select.php';
    $recipe = getRecipeList();

    echo '<div class="container text-center">';
    echo '<div class="row">';
    foreach($recipe as $row){
        echo '<div class="col-12 col-md-6 col-lg-4">';
            echo '<div class="card">';
                echo '<a href="recipeDetail.php?id='.$row['id'].'">';
                    echo '<img src=',$row['img_path'],' class="card-img-top">';
                    echo '<div class="card-body">';
                        echo '<div>',$row['dish_name'],'</div>';
                    echo '</div>';
                echo '</a>';
            echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    require './common/footer.php';
?>