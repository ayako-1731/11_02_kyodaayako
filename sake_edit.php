<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
include("functions.php");
 

// idの受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();  



// データ取得SQL作成
$sql = 'SELECT * FROM sakenomi_table WHERE id=:id';  
$stmt = $pdo->prepare($sql);  
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$status = $stmt->execute();

// SQL準備&実行
$sql = '';


// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC); 
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sake.css">
  <title>Sakenomi Shopping（編集画面）</title>
</head>

<body>
  <form action="sake_update.php" method="POST">
   <input type="hidden" name="id" value="<?=$record['id']?>">
   <div class="header_title"> 
      <h1>Sakenomi Shopping</h1>
   </div>    
      <p>（編集画面）</p>
      <a href="sake_read.php">一覧画面</a>

      <div class="product" name="product">
      ● 商　品 : <select type="text" name="product">
          <option value="商品名" selected>商品を選択</option>
          <option value="庭のうぐいす 純米吟醸">庭のうぐいす 純米吟醸</option>
          <option value="庭のうぐいす 特別純米">庭のうぐいす 特別純米</option>
          <option value="庭のうぐいす 純米吟醸 ぬるはだ">庭のうぐいす 純米吟醸 ぬるはだ</option>
          <option value="庭のうぐいす おうから">庭のうぐいす おうから</option>
          <option value="庭のうぐいす 特別純米 しぼりたて">庭のうぐいす 特別純米 しぼりたて</option>
          <option value="庭のうぐいす 純米吟醸 あらばしり">庭のうぐいす 純米吟醸 あらばしり</option>
          <option value="庭のうぐいす 特別純米 なつがこい">庭のうぐいす 特別純米 なつがこい</option>
          <option value="庭のうぐいす 純米吟醸 いなびかり">庭のうぐいす 純米吟醸 いなびかり</option>
          <option value="庭のうぐいす 純米大吟醸 くろうぐ<">庭のうぐいす 純米大吟醸 くろうぐ</option>
          <option value="庭のうぐいす 大吟醸 心">庭のうぐいす 大吟醸 心</option>
          </select> 
      </div>

      <div class="budget">
      ● 予　算 : <select type="text" name="budget">
        <option value="金額の予算" selected>金額の予算を選択</option>
        <option value="千円以内">~1,000</option>
        <option value="二千円以内">1,000~2,000</option>
        <option value="三千円以内">2,000~3,000</option>
        <option value="四千円以内">3,000~4,000</option>
        <option value="四千円以上">4,000~</option>
        </select> 円
    </div>

    <div class="items">
      ● 種　類 : <select type="text" name="items">
        <option value="選択肢" selected>種類を選択</option>
        <option value="吟醸酒">吟醸酒</option>
        <option value="純米酒">純米酒</option>
        <option value="本醸造酒">本醸造酒</option>
        </select>
    </div>

    <div class="taste">
      ● タイプ : <select type="text" name="taste">
        <option value="辛口">辛口</option>
        <option value="甘口">甘口</option>
        </select>
    </div>

     <div>
        <button>送信する</button>
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
  </form>

</body>

</html>