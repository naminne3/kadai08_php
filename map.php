<!DOCTYPE html>
<html>
<head>
  <title>日本地図</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>訪問済み都道府県</h1>

  <?php
    // read.phpを読み込んで、訪問情報を取得
    require_once('read.php'); 
  ?>

  <svg id="japan-map" viewBox="0 0 1000 1000">
    <?php include 'japan.svg'; ?>
  </svg>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script.js"></script>
</body>
</html>