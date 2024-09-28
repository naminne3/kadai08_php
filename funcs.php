<?php
// この部分の記述については講義でも触れますのでご留意ください

//DB接続用の関数
function db_conn()
{
    try {
     // db_name, db_host, db_id, db_pwをご自身のものに書き換えて使用して下さい
        // $db_name =  'lifXXXXign';            //データベース名
        // $db_host =  'lifecaXXXXa.ne.jp';  //DBホスト
        // $db_id =    'gs_XXai08';                //アカウント名(登録しているドメイン)
        // $db_pw =    'gs_dXXdai08';           //さくらサーバのパスワード
        
        $db_name =  'lifecareerdesign_gs_db_kadai08';            //データベース名
        $db_host =  'localhost';  //DBホスト
        $db_id =    'root';                //アカウント名(登録しているドメイン)
        $db_pw =    '';           //さくらサーバのパスワード

        $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
        $pdo = new PDO($server_info, $db_id, $db_pw);
        
        return $pdo;

    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー用の関数
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

?>