<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

//1. POSTデータ取得
//[name,email,age,naiyou]
$date   = $_POST["date"];
$prefecture  = $_POST["prefecture"];
$companion    = $_POST["companion"];
$memory = $_POST["memory"];

//2. DB接続します PDO=php data object localhost以下はさくらの時はさくらのものを入れる exit＝エラー出たから処理止めるよの関数（ここで止まってしまうので注意）
try {
  //Password:MAMP='root',XAMPP=''
  // さくら
  // $pdo = new PDO('mysql:dbname=lifecareerdesign_gs_db_kadai08;charset=utf8;host=localhost','root','');
  // ローカル
  $pdo = new PDO('mysql:dbname=lifecareerdesign_gs_db_kadai08;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONECT:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO gs_an_table(date,prefecture,companion,memory,indate)VALUES(:date,:prefecture,:companion,:memory,sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':date',   $date,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':prefecture',  $prefecture,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':companion',    $companion,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memory', $memory,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}



//5. select
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