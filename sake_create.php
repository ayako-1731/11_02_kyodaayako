<?php
session_start();
include('functions.php'); 
check_session_id();

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['product']) || $_POST['product'] == '' ||
  !isset($_POST['budget']) || $_POST['budget'] == '' ||
  !isset($_POST['items']) || $_POST['items'] == ''||
  !isset($_POST['taste']) || $_POST['taste'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$product = $_POST['product'];
$budget = $_POST['budget'];
$items = $_POST['items'];
$taste = $_POST['taste'];

// DB接続の設定

 $pdo = connect_to_db(); 
// DB名は`gsacf_x00_00`にする
// $dbn = 'mysql:dbname=YOUR_DB_NAME;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//   // ここでDB接続処理を実行する
//   $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//   // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
//   echo json_encode(["db error" => "{$e->getMessage()}"]);
//   exit();
// }

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO sakenomi_table(id, product, budget, items, taste, created_at, updated_at) VALUES(NULL, :product,:budget, :items, :taste, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product', $product, PDO::PARAM_STR);
$stmt->bindValue(':budget', $budget, PDO::PARAM_STR);
$stmt->bindValue(':items', $items, PDO::PARAM_STR);
$stmt->bindValue(':taste', $taste, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動する
  header("Location: sake_read.php");
  exit();
}
?>