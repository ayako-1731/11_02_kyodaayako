<?php
session_start();
include('functions.php'); 
check_session_id();

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

// いいね数カウント
$sql = 'SELECT product_id, COUNT(id) AS cnt FROM sakebuy_table GROUP BY product_id';  
$stmt = $pdo->prepare($sql);  
$status = $stmt->execute();
  if ($status == false) {    // エラー処理  
  } else {    
    $buy_count = $stmt->fetchAll(PDO::FETCH_ASSOC);// fetchAllで全件取得  
    // var_dump($buy_count);    
    // exit();  
  }

// データ取得SQL作成
$sql = 'SELECT * FROM sakenomi_table           
        LEFT OUTER JOIN (SELECT product_id, COUNT(id) AS cnt           
        FROM sakebuy_table GROUP BY product_id) AS buys           
        ON sakenomi_table.id = buys.product_id'; 

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // echo json_encode(["error_msg" => "{$error[2]}"]);
  // exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  
  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["product"]}</td>";
    $output .= "<td>{$record["budget"]}</td>";
    $output .= "<td>{$record["items"]}</td>";
    $output .= "<td>{$record["taste"]}</td>"; 
    $output .= "<td><a href='sakebuy_create.php?user_id={$user_id}&product_id={$record["id"]}'>注文数{$record["cnt"]}</a></td >"; 
    // edit deleteリンクを追加
    $output .= "<td><a href='sake_edit.php?id={$record["id"]}'>編集</a></td>";    
    $output .= "<td>                
                <a href='sake_delete.php?id={$record["id"]}'>消去</a></td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
//   unset($record);
} 
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sake.css">
  <title>購入履歴（一覧画面）</title>
</head>

<body>
  <div>

  <div class="header_title"> 
    <h1>購入履歴</h1>
  </div>   
    <div id="tbl_bdr">
      <table width="100%">
        <thead>
          <tr>
            <th>商品名</th>
            <th>金  額</th>
            <th>種  類</th>
            <th>タイプ</th>
            <th>購  入</th>
            <th>操作①</th>
            <th>操作②</th>
          </tr>
        </thead>
        <tbody>
          <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
          <?= $output ?>
        </tbody>
     </table>
    </div> 

    <section id="campany_access">
            <div class="Access">
                <div class="access_company">
                    <h2>ACCESS</h2>
                    <p>店舗情報</p>
                </div> 
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.7989113355916!2d130.38428451441132!3d33.58456998073583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541922b46f076b7%3A0x1722d8abf73f106d!2z5Y6f6YWS5bqX!5e0!3m2!1sja!2sjp!4v1592048272008!5m2!1sja!2sjp" width="700" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                <div class="school">
                    <table>
                        <tbody>
                            <tr> 
                                <td><p>店舗名</p></td>
                                <td><p>原酒店</p></td>
                            </tr>
                            <tr>
                                <td><p>所在地</p></td>
                                <td><p>〒810-0042 福岡県福岡市中央区赤坂２丁目５−３８</p></td>
                            </tr>
                            <tr>
                                <td><p>TEL</p></td>
                                <td><p>092-741-1159</p></td>
                            </tr>
                            <tr>
                                <td><p>営業時間</p></td>
                                <td><p>10:30～20:00</p></td>
                            </tr>
                            <tr>
                                <td><p>店休日</p></td>
                                <td><p>日曜日・祝日</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section> 
    
    <p><a href="sake_input.php">入力画面</a></p>
    <p><a href="sake_logout.php">ログアウト</a></p> 
</body>

</html>