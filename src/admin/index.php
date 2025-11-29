<?php
    session_start();

// ログインしていなければsignin.phpにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: ../admin/auth/signin.php');
    exit();
}
$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    // 接続成功時
    // echo 'Connection to DB successful';
} catch (PDOException $e) {
    // 接続失敗時
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);

// データ取得
$sql = "SELECT * FROM questions";
$result = $dbh->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/add.css">
    <script src="../assets/scripts/delete.js" defer></script>
    <title>問題一覧</title>
</head>
<body>
    <header>
        <div class="header_logo"><img src="../assets/img/logo.svg" alt=""></div>
        <div class="header_button">
            <form action="./logout.php" method="POST">
                <button type="submit">ログアウト</button>
            </form>
    </div>
    </header>
    <main>
        <section class="left_menu">
            <div>
                <a href=""><p>ユーザー招待</p></a>
                <a href="./index.php"><p>問題一覧</p></a>
                <a href="./questions/create.php"><p>問題作成</p></a>
            </div>
        </section>
<!-- ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
これ以降がメインコンテンツ

week24.25のファイル設定および削除機能の実装ができていません
削除機能についてはquestion テーブルとchoices テーブルの両方から削除する必要がありますが、
questionsテーブルのidをchoicesテーブルのquestion_idと同期したので(init.sql55-64行目)(親がquestionsテーブル、子がchoicesテーブル)
questuionsテーブルのidを指定して削除すれば両方から削除できるようになっています。

week28
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
        <section class="main_contents">
            <h1>問題一覧</h1>
            <div class="contents_header">
                <h2>ID</h2>
                <h2>問題</h2>
            </div>
            <?php foreach($questions as $i => $questions) { ?>
            <form method="post" action="index.php">
                <input type="hidden" name="text" value="form<?= $i+1 ?>">
            <div class="contents_body" data-id="<?= $questions['id']?>">
                <div>
                    <span class="id_number"><?= $i+1 ?></span>
                    <a class="question_text" href="./questions/edit.php?id=<?= $i+1 ?>" name="question_text" id="question_text"><?= $questions["content"];?></a>
                </div>
                <button id="delete-btn" class="delete-btn" data-id="<?= $questions['id']?>">削除</button>
            </div>
            </form>
            <?php } ?>
            
        </section>
    </main>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['arrayData'])) {
    $data = json_decode($_POST['arrayData'], true);
    // $data['questions'] や $data['choices'] を使ってDBに保存する処理を書く
    // 例: $dbh->prepare("INSERT INTO ...")->execute([...]);
    echo "保存しました";
    exit;
}
?>
<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
//     $delete_id = intval($_POST['delete_id']);

//     try {
//         // トランザクション開始
//         $dbh->beginTransaction();

//         // choices テーブルの選択肢を削除
//         $stmt = $dbh->prepare("DELETE FROM choices WHERE problem_id = ?");
//         $stmt->execute([$delete_id]);

//         // questions テーブルの問題を削除
//         $stmt = $dbh->prepare("DELETE FROM questions WHERE id = ?");
//         $stmt->execute([$delete_id]);

//         // トランザクションコミット
//         $dbh->commit();

//         echo "削除しました";
//     } catch (PDOException $e) {
//         // エラーが発生した場合、ロールバックしてエラーメッセージを表示
//         $dbh->rollBack();
//         echo "エラーが発生しました: " . $e->getMessage();
//     }
// }
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>


