<?php
  // セッションを開始
  session_start(); 

  // 訪問情報をセッションに保存
  if (isset($_POST['prefecture'])) {
    // 訪問情報をセッションに保存
    $_SESSION['visitedPrefectures'][$_POST['prefecture']] = true;

    // CSVに記録するデータ
    $data = [
      $_POST['date'],
      $_POST['prefecture'],
      $_POST['companion'],
      trim($_POST['memory']) // trim() 関数で空白文字や特殊文字を削除
    ];

    // CSVファイルに書き込み
    $file = fopen('record.csv', 'a'); 
    fputcsv($file, $data); // fputcsvは自動的に改行を行うので、fwriteは不要
    fclose($file); 
  }

  // index.phpへリダイレクト
  header('Location: index.php'); 
  exit;
?>
