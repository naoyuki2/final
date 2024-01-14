<?php
    require './common/index_header.php'
?>
<div class="opening" id="opening">
    <img src="./img/opening.jpg" alt="" class="logo" id="logo">
</div>

<div class="item-wrap" id="itemWrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="comment fs-4">ようこそレシピ共有アプリ</p>
                <p class="fs-5">ここでは自分のレシピをみんなに共有することができます。</p>
                <p class="fs-5">安心してください。レシピを書いた人は誰にも知られることはありません。</p>
                <p class="fs-5">いいねも、コメントもありません。</p>
                <a href="./top.php">
                    <input class="btn btn-outline-secondary" type="button" value="さっそく始める">
                </a>
            </div>
        </div>
    </div>
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