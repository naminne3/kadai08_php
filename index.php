<?php
ini_set('display_errors', 1); // エラーを表示する設定
error_reporting(E_ALL);       // 全てのエラーを報告する設定
?>


<!DOCTYPE html>
<html>
<head>
  <title>旅行記録</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="content-wrapper"> 
  <h1>旅行記録</h1>


  <?php
// 関数用のファイルを使用できるように呼び出す
require_once('funcs.php');

// 上記のfuncs.phpに書いている関数(db_conn)を呼び出して
// データベースに接続し、データ取得できるようにします。
// なるべく呼び出し先の関数と同じ変数名($pdoのことです)にしておくのが混乱を防ぐのにおすすめです
$pdo = db_conn();

// 下記でSQL文を実行します
// 下記ではgs_test_tableテーブルのデータを全権取得する書き方になっています
$stmt = $pdo->prepare('SELECT * FROM gs_an_table');
// 実行結果をboolean(true or false)で取得します
$status = $stmt->execute();

//３．データ表示
// $view=""; 無視

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

?>


  <?php
    // read.php を読み込んで、訪問情報を取得
    require_once('read.php'); 
  ?>

  <form action="insert.php" method="post">
    <label for="date">訪問日時:</label>
    <input type="date" id="date" name="date" required><br><br>

    <label for="prefecture">場所:</label>
    <select id="prefecture" name="prefecture" required>
      <?php
        // prefectures.php を読み込む
        require_once('prefectures.php'); 

        // 都道府県名を表示するオプションを生成
        // foreach ($prefectures as $prefecture) {
        //   // 既に訪問済みであれば selected 属性を追加
        //   $selected = isset($visitedPrefectures[$prefecture]) && $visitedPrefectures[$prefecture] ? 
        //   'selected' : '';
        //   echo "<option value=\"$prefecture\" $selected>$prefecture</option>";
        // }
      ?>
    </select><br><br>

    <label for="companion">同行者:</label>
    <input type="text" id="companion" name="companion"><br><br>

    <label for="memory">思い出:</label>

    <?php
    // ここで $memory 変数を初期化
    $memory = isset($memory) ? $memory : '';
?>

    <textarea id="memory" name="memory" rows="5" cols="40"><?php echo $memory; ?></textarea><br><br>


    <button type="submit">登録</button>
  </form>



  <h2>訪問先一覧</h2>

  <div id="mapContainer">

    <!-- japan.svg ファイルの内容を直接読み込んで表示 -->
    <svg id="japan-map" viewBox="0 0 1000 1000">
          <?php
          // SVGの内容を直接出力せず、一旦変数に読み込む
          $svgContent = file_get_contents('japan.svg');
          echo $svgContent; // ここで出力
          ?>
        </svg>
  </div>

  <div id="tableContainer">
    <table id="recordTable" border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>訪問日</th>
          <th>場所</th>
          <th>内容</th>
          <th>同行者</th>
          <th>入力日</th> 
        </tr>
      </thead>
      <tbody>
        
      
            
          
            <?php foreach($values as $value){ ?>
              <tr>
              <td><?=$value["id"] ?></td>
              <td><?=$value["date"] ?></td>
              <td><?=$value["prefecture"] ?></td>
              <td><?=$value["memory"] ?></td>
              <td><?=$value["companion"] ?></td>
              <td><?=$value["indate"] ?></td>
            </tr>
    
        <?php }; ?>



              
      </tbody>
    </table>
  </div>
 </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script.js"></script>

  </body>
</html>