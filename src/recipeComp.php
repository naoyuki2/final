<?php
    require './common/header.php';
    $recipe_id = $_GET['recipe_id'];
?>

<h1>投稿が完了しました！</h1>
<p>もし、レシピを編集したり、削除する場合のために秘密の暗号を設定しませんか？</p>
<form action="./process/secretKeyInsert.php?recipe_id=<?php echo $recipe_id;?>" method="post">
<input type="text" name="secret_key" placeholder="秘密の暗号">
<button type=submit >設定する</button>
</form>
<a href="top.php">
    <button>topに戻る</button>
</a>

<?php require './common/footer.php'; ?>