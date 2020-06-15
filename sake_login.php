<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sake.css">
  <title>Sakenomi Shoppingログイン画面</title>
</head>

<body>
  <form action="sake_login_act.php" method="POST">
    <div class="header_title">
      <h1>Sakenomi Shopping</h>
    </div>
    <p>【ユーザーログイン画面】</p>
    <p>利用時にIDとパスワードをご入力ください☺</p>

    <div>
      user_id : <input type="text"  name="user_id">
    </div>
    <div>
      password: <input type="text" name="password">
    </div>
    <div>
      <button>Login</button>
    </div>
    <a href="sake_register.php">初回登録</a>

    <!-- <section id="campany_access">
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
    </section> -->
  </form>
</body>

</html>