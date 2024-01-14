<?php
    require './common/index_header.php'
?>
<div class="opening" id="opening">
    <img src="./img/opening.jpg" alt="" class="logo" id="logo">
</div>

<div class="item-wrap" id="itemWrap">
    <h1 class="comment">ようこそレシピ共有アプリへ</h1>
    <p>ここでは自分のレシピをみんなに共有することができます。</p>
    <p>安心してください。レシピを書いた人は誰にも知られることはありません。</p>
    <p>いいねも、コメントもありません。</p>
    <a href="./top.php">
        <input class="btn btn-outline-secondary" type="button" value="さっそく始める">
    </a>
</div>

<?php
    require './common/footer.php';
?>

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