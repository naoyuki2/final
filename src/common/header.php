<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/index.css" />

    <title>Recipient</title>
    <script src="./lib/suggest.js"></script>
</head>
<body>
<div class="wrap">
<nav class="mb-5 navbar navbar-expand-xl navbar-light" style="background-color: #f6ca99;">
  <div class="container-fluid">
    <?php
        if(isset($_GET['id']) || isset($_GET['write'])){
            echo '<i class="backButton fa-solid fa-arrow-left fa-3x" id="backButton"></i>';
        }else{
            echo '<div></div>';
        }
    ?>

    <form>
      <input class="px-5 form-control me-2" type="search" placeholder="レシピを検索" aria-label="Search">
      <!-- <i class="fa-solid fa-magnifying-glass"></i> 虫眼鏡のアイコン -->
    </form>

    <div>
        <a href="recipeWrite.php?write=true">レシピを書く</a>
    </div>
  </div>
</nav>

<script>
    window.addEventListener('load', () => {
    const wrap = document.querySelector('.wrap');
    setTimeout(() => {
      wrap.classList.add('active');
    }, 200); // n秒後に.wrapを表示
    });
</script>