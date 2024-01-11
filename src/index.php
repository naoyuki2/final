<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipient</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<div class="opening" id="opening">
    <img src="./img/opening3.jpg" alt="" class="logo" id="logo">
</div>

<div class="item-wrap" id="itemWrap">
    <h1 class="comment">ようこそレシピ共有アプリへ</h1>
    <p>ここでは自分のレシピをみんなに共有することができます。</p>
    <p>安心してください。レシピを書いた人は誰にも知られることはありません。</p>
    <p>いいねも、コメントもありません。</p>
    <a href="./top.php">
        <input type="button" value="さっそく始める">
    </a>
</div>
</body>
</html>

<script>
    const logo = document.getElementById('logo');
    const opening = document.getElementById('opening');
    const itemWrap = document.getElementById('itemWrap');

    logo.addEventListener('animationend', () => {
    opening.classList.add('close');
    });

    opening.addEventListener('transitionend', () => {
    itemWrap.classList.add('active');
    });

</script>