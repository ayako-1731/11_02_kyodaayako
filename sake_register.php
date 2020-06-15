<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sake.css">
  <title>Sakenomi Shoppingユーザー登録画面</title>
</head>

<body>
  <form action="sake_register_act.php" method="POST">
    <div class="header_title">
      <h1>Sakenomi Shopping</h>
    </div>
    <p>【ユーザー登録画面】</p>
    <div>
      user_id: <input type="text" name="user_id">
    </div>
    <div>
      password: <input type="text" name="password">
    </div>
    <div>
      <button>初回登録</button>
    </div>
    <a href="sake_login.php">or login</a>
  </form>
</body>

</html>