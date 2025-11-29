<?php
session_start();  // セッションを開始
$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    // echo 'Connection failed: ' . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // ===week27(バリデーション)始================================================
    if(empty($_POST['password'])){
        echo 'パスワードは必須項目です。';
    }
    if (strlen($_POST['password']) < 3) {
        echo '3文字以上のパスワードを設定してください。';
    }  
    if (!preg_match('/^[^@\s]+@[^@\s]+\.com$/u', $_POST['email'])) {
        echo '入力内容が正しくありません';
}
// ハッシュを作成（ソルトは自動生成・埋め込みされます）
$hash = password_hash($password, PASSWORD_DEFAULT);
// var_dump($hash);


    // ===week27(バリデーション)終================================================

    // パスワードは本来ハッシュ化して比較します（例: password_verify）
    $stmt = $dbh->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($user); // ここで取得結果を確認

    if ($user) {
        header('Location: /admin/index.php');
        $_SESSION['user_id'] = $user['id'];  // セッションにユーザーIDを保存
        exit;
    } else {
        header('Location: ./signin.php');
        echo 'メールアドレスまたはパスワードが正しくありません。';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/add.css">
    <script src="" defer></script>
    <title>サインイン</title>
</head>
<body>
    <header>
        <div class="header_logo"><img src="../../assets/img/logo.svg" alt=""></div>
        <div class="header_button"><a href="../../index.php" src="../index.php">ログアウト</a></div>
    </header>
    <main class="signin_form">
        <section >
            <form action="signin.php" method="POST">
  <!-- メールアドレス -->
  <div>
    <label for="email">メールアドレス：</label>
    <input type="email" id="email" name="email">
  </div>
  <!-- パスワード -->
  <div>
    <label for="password">パスワード：</label>
    <input type="password" id="password" name="password" minlength="2">
  </div>
  <input type="submit" value="ログイン"> 
</form>
<p>bbb@gmail.com</br>ccc</p>
        </section>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>


