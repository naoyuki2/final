<?php
    $uploaded_file = $_FILES['img_path'];
    if(!empty($uploaded_file['name'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // ファイルがアップロードされていることを確認
            if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] == 0) {
                $uploaded_file = $_FILES['img_path'];

                // ファイルの拡張子を確認
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $file_extension = pathinfo($uploaded_file['name'], PATHINFO_EXTENSION);
                if (in_array($file_extension, $allowed_extensions)) {
                    // 保存先のパスを指定
                    $destination = '../../uploads/' . $uploaded_file['name'];

                    // ファイルを指定した場所に移動      
                    if (move_uploaded_file($uploaded_file['tmp_name'], $destination)) {
                        $_SESSION['insertMessage'] = "File uploaded successfully.";
                    } else {
                        $_SESSION['insertMessage'] = "Failed to upload file.";
                        header('Location: recipeWrite.php');
                    }
                } else {
                    $_SESSION['insertMessage'] = "Invalid file extension.";
                    header('Location: recipeWrite.php');
                }
            } else {
                $_SESSION['insertMessage'] = "No file uploaded.";
                header('Location: recipeWrite.php');
            }
        }
    }else{
        $destination = './img/default.jpg';
    }

    require '../utils/insert.php';
    require '../utils/select.php';

    postCategory($_POST['category_name']);

    foreach($_POST['ingredient_name'] as $ingredient){
        postIngredient($ingredient);
    }

    $category_id = getCategoryId($_POST['category_name']);
    // echo $category_id['id'];

    $img_path = mb_substr($destination, 3);

    postRecipe($_POST['dish_name'], $_POST['process'], $img_path, $category_id['id']);

    $recipe_id = getRecipeId($_POST['dish_name']);

    array_map(function($i, $q, $u) {
        global $recipe_id;
        $ingredient_id = getIngredientId($i);
        postRecipeIngredientLink($recipe_id['id'], $ingredient_id['id'], $q, $u);
    }, $_POST['ingredient_name'], $_POST['quantity'], $_POST['unit']);

    echo '<h1>recipe投稿</h1>'

    // // 著者の存在チェック
    // $stmt = $pdo->prepare("SELECT COUNT(*) FROM author WHERE author_name = ?");
    // $stmt->execute([$_POST['author']]);
    // $count = $stmt->fetchColumn();
    // if ($count == 0) {
    //     // 著者が存在しない場合、新しい著者を追加
    //     $stmt = $pdo->prepare("INSERT INTO author (author_name) VALUES (?)");
    //     $stmt->execute([$_POST['author']]);
    // }

    // //カテゴリのidを取得
    // $stmt = $pdo->prepare("SELECT category_id FROM category WHERE category_name = ?");
    // $stmt->execute([$_POST['category']]);
    // $category = $stmt->fetch(PDO::FETCH_ASSOC)['category_id'];

    // //著者のidを取得
    // $stmt = $pdo->prepare("SELECT author_id FROM author WHERE author_name = ?");
    // $stmt->execute([$_POST['author']]);
    // $author = $stmt->fetch(PDO::FETCH_ASSOC)['author_id'];

    // if(empty($_POST['title']) || empty($category) || empty($author) || empty($_POST['thought']) || empty($_POST['price']) || empty($destination)){
    //     $_SESSION['insertMessage'] = "未入力の項目があります";
    //     header('Location: productsInsertInput.php');
    // }

    // $sql=$pdo->prepare('insert into products values(null,?,?,?,?,?,?,0)');
    // $sql->execute([
    //     $_POST['title'],
    //     $category,
    //     $author,
    //     $_POST['thought'],
    //     $_POST['price'],
    //     $destination
    // ]);

    // $stmt=$pdo->prepare('select * from products where title = ?');
    // $stmt->execute([$_POST['title']]);
    // $product_id = $stmt->fetch();

    // $sql=$pdo->prepare('insert into stock values(null,?,?)');
    // $sql->execute([
    //     $product_id['product_id'],
    //     $_POST['stock']
    // ]);

    // $_SESSION['dbMessage'] = "DB inserted successfully.";
    // header('Location: productsInsertInput.php');
    // exit;
?>
