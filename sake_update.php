<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include('functions.php'); 

// 送信データ受け取り
$id = $_POST['id']; 
$product = $_POST['product'];
$budget = $_POST['budget'];
$items = $_POST['items'];
$taste = $_POST['taste'];

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE sakenomi_table SET product=:product,budget=:budget,items=:items,taste=:taste,updated_at=sysdate() WHERE id=:id";  
$stmt = $pdo->prepare($sql);  
$stmt->bindValue(':product', $product,  PDO::PARAM_STR);  
$stmt->bindValue(':budget',  $budget,   PDO::PARAM_STR);  
$stmt->bindValue(':id',      $id,       PDO::PARAM_INT);
$stmt->bindValue(':items',   $items,    PDO::PARAM_STR); 
$stmt->bindValue(':taste',   $taste,    PDO::PARAM_STR); 
$status = $stmt->execute();
 

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:sake_read.php");    
  exit(); 
}
