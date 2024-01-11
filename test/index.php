<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="opening" id="opening">
  <img src="../src/img/default.jpg" alt="" class="logo" id="logo">
</div>

<div class="item-wrap" id="itemWrap">

  <img src="../src/img/default1.jpg" alt="" class="hello" width="130px">

  <img src="../src/img/default2.jpg" alt="" class="item item1">

  <img src="../src/img/default.jpg" alt="" class="item item2">
  
  <p class="comment">ようこそロジカルスタジオへ</p>
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