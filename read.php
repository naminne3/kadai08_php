<?php
  // セッションを開始
  session_start(); 

  // セッションから訪問情報を読み込み
  $visitedPrefectures = $_SESSION['visitedPrefectures'] ?? [];

  // JavaScriptで利用するために、PHPの配列をJavaScriptの配列に変換
  $jsPrefectures = json_encode($visitedPrefectures); 
  echo "<script> var visitedPrefectures = $jsPrefectures; </script>"; 
?>