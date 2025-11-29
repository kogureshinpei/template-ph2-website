    <?php
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

$id = $_GET['id'];

$questions = $dbh->query("SELECT * FROM questions WHERE id = $id")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices WHERE problem_id = $id")->fetchAll(PDO::FETCH_ASSOC);
$question = $dbh->query("SELECT content FROM questions WHERE id = $id")->fetchAll(PDO::FETCH_ASSOC);
$image = $dbh->query("SELECT image FROM questions WHERE id = $id")->fetchAll(PDO::FETCH_ASSOC);
$supplement = $dbh->query("SELECT supplement FROM questions WHERE id = $id")->fetchAll(PDO::FETCH_ASSOC);


// フォームの処理
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $data['questions'];
    $data['choices'];
    $questionArray = $data['questions'];
    $choicesArray = $data['choices'];

    // $content = $_POST['content'];
    // $name = $_POST['name'];
    // $valid = $_POST['valid'];
    // $image = $_POST['image'];
    // $supplement = $_POST['supplement'];

    // 画像の処理
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_path = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_path = null;
    }

    $stmt = $dbh->prepare("INSERT INTO questions (content, image, supplement) VALUES (?, ?, ?)");
    $stmt->execute([$questionArray[0], $questionArray[1], $questionArray[2]]);
    $problem_id = $dbh->lastInsertId();
    foreach ($choicesArray as $choice) {
        $stmt = $dbh->prepare("INSERT INTO choices (problem_id, name, valid) VALUES (?, ?, ?)");
        $stmt->execute([$problem_id, $choice[0], $choice[1]]);
    }

    // echo "保存しました";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/scripts/edit.js" defer></script>
    <link rel="stylesheet" href="../..//assets/styles/add.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header_logo"><img src="../../assets/img/logo.svg" alt=""></div>
        <div class="header_button">
            <form action="../logout.php" method="POST">
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        <section class="left_menu">
            <div>
                <a><p>ユーザー招待</p></a>
                <a href="../index.php"><p>問題一覧</p></a>
                <a href="./create.php"><p>問題作成</p></a>
            </div>
        </section>
    <main>
        
        <section class="main_contents_2">
            <div>
                <h1>問題編集</h1>
            </div>
            <div class="form_area">
                <?php foreach ($questions as $i => $questions) { ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="space">
                        <label for="question">問題文:</label><br>
                        <input type="text" placeholder="問題文を入力してください" name="content" value="<?= htmlspecialchars($questions['content'] ?? '') ?>">
                    </div>
                    <div class="space">
                        <label for="select">選択肢:</label><br>
                        <input type="text" name="name" placeholder="選択肢1を入力してください" value="<?= htmlspecialchars($choices[0]['name'] ?? '') ?>">
                        <input type="text" name="name" placeholder="選択肢2を入力してください" value="<?= htmlspecialchars($choices[1]['name'] ?? '') ?>">
                        <input type="text" name="name" placeholder="選択肢3を入力してください" value="<?= htmlspecialchars($choices[2]['name'] ?? '') ?>">
                    </div>
                    <div class="space">
                        <label for="answer">正解の選択肢</label><br>
                        <div class="radio-option">
                            <input type="radio" id="option1" name="valid" value="option1" <?= ($choices[0]['valid'] ?? '') ? 'checked' : '' ?>>
                            <label for="option1">選択肢1</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="option2" name="valid" value="option2" <?= ($choices[1]['valid'] ?? '') ? 'checked' : '' ?>>
                            <label for="option2">選択肢2</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="option3" name="valid" value="option3" <?= ($choices[2]['valid'] ?? '') ? 'checked' : '' ?>>
                            <label for="option3">選択肢3</label>
                        </div>
                    </div>
                    <div class="space">
                        <label for="image">問題の画像</label><br>
                        <input class="" type="file" name="image" accept="image/*" value="<?= htmlspecialchars($questions['image'] ?? '') ?>">
                    </div>
                    <div class="space">
                        <label for="point">補足:</label><br>
                        <input type="text" name="supplement" placeholder="補足を入力してください" value="<?= htmlspecialchars($questions['supplement'] ?? '') ?>">
                    </div>
                    <button type="submit" id="submit">
                        <a href="../index.php">編集完了</a>
                    </button>
                </form>
            </div>
            <?php } ?>
        </section>
    </main>
</body>
</html>

<a href="../../vendor/composer/"></a>