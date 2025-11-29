
<?php
require "../../vendor/autoload.php";
use Verot\Upload\Upload;


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
// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// $choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);
// $content = $dbh->query("SELECT content FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// $image = $dbh->query("SELECT image FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// $supplement = $dbh->query("SELECT supplement FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// $name = $dbh->query("SELECT name FROM choices")->fetchAll(PDO::FETCH_ASSOC);
// $valid = $dbh->query("SELECT valid FROM choices")->fetchAll(PDO::FETCH_ASSOC);

// フォームの処理
// if($_SERVER['REQUEST_METHOD'] === 'POST'){
//     $json = file_get_contents('php://input');
//     $data = json_decode($json, true);

//     $data['questions'];
//     $data['choices'];
//     $questionArray = $data['questions'];
//     $choicesArray = $data['choices'];

//     // $content = $_POST['content'];
//     // $name = $_POST['name'];
//     // $valid = $_POST['valid'];
//     // $image = $_POST['image'];
//     // $supplement = $_POST['supplement'];

//     // 画像アップロード処理
//     if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) { // 画像がアップロードされているか確認
//         // ランダムなファイル名を生成し、拡張子を保持
//         $image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);

//         // 保存場所を指定
//         $image_path = dirname(FILE) . '/../../assets/img/quiz/' . $image_name;

//         // アップロードされたファイルを指定したパスに移動
//         move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
//     } else {
//         $image_name = null; // 画像がない場合はnullをセット
//     }

// // ===========================week28画像アップロードライブラリ導入ここから===========================
// $file = $_FILES['image'];
// $lang = 'ja_JP';

// // アップロードされたファイルを渡す
// $handle = new Upload($file, $lang);

// if ($handle->uploaded) {
//   // アップロードディレクトリを指定して保存
//   $handle->process('../../assets/img/quiz/');
//   if ($handle->processed) {
//     // アップロード成功
//     $image_name = $handle->file_dst_name;
//   } else {
//     // アップロード処理失敗
//     throw new Exception($handle->error);
//   }
// } else {
//   // アップロード失敗
//   throw new Exception($handle->error);
// }

// // ===========================week28画像アップロードライブラリ導入ここまで===========================


//     $stmt = $dbh->prepare("INSERT INTO questions (content, image, supplement) VALUES (?, ?, ?)");
//     $stmt->execute([$questionArray[0], $questionArray[1], $questionArray[2]]);
//     $problem_id = $dbh->lastInsertId();
//     foreach ($choicesArray as $choice) {
//         $stmt = $dbh->prepare("INSERT INTO choices (problem_id, name, valid) VALUES (?, ?, ?)");
//         $stmt->execute([$problem_id, $choice[0], $choice[1]]);
//     }

//     echo "保存しました";
//     exit;
// }


// フォームから送信されたデータを受け取る
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // 各入力項目を取得
//     $content = $_POST['content'];  // 問題文
//     $choices = $_POST['select'];   // 選択肢
//     $valid = $_POST['choice'];  // 正解の選択肢
//     $supplement = $_POST['supplement'];  // 補足情報

//     // 入力チェック
//     if (empty($content)) {
//         echo "問題文を入力してください。";
//         exit;
//     }
//     $valid = isset($_POST['choice']) ? $_POST['choice'] : null;  // or $_POST['choice'] ?? null;

// if ($valid === null) {
//     echo "正解の選択肢を選んでください。";
//     exit;
// }

//     if (empty($choices) || count($choices) < 3) {
//         echo "選択肢は3つ以上入力してください。";
//         exit;
//     }

//     if (!isset($valid)) {
//         echo "正解の選択肢を選んでください。";
//         exit;
//     }

//     // 画像アップロード処理
//     if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
//         $image_name = uniqid(mt_rand(), true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
//         $image_path = dirname(__FILE__) . '/../../assets/img/quiz/' . $image_name;
//         move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
//     } else {
//         $image_name = null;  // 画像がない場合はnullをセット
//     }

//     // 質問をデータベースに挿入
//     try {
//         $stmt = $dbh->prepare("INSERT INTO questions (content, image, supplement) VALUES (?, ?, ?)");
//         $stmt->execute([$content, $image_name, $supplement]);
//         $problem_id = $dbh->lastInsertId(); // 新しく挿入した問題のIDを取得
//     } catch (PDOException $e) {
//         echo 'Error inserting question: ' . $e->getMessage();
//         exit;
//     }

//     // 選択肢をデータベースに挿入
//     try {
//         foreach ($choices as $index => $choice) {
//             $valid_choice = ($index == $valid) ? 1 : 0;  // 正解の選択肢を特定
//             $stmt = $dbh->prepare("INSERT INTO choices (problem_id, name, valid) VALUES (?, ?, ?)");
//             $stmt->execute([$problem_id, $name, $valid_choice]);
//         }
//     } catch (PDOException $e) {
//         echo 'Error inserting choice: ' . $e->getMessage();
//         exit;
//     }

//     echo "保存しました";
//     exit;
// }
// ーーーーーーーーーーーーーーーーーーー・
// フォームから送信されたデータを受け取る
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. フォームの値を取得（trim しておくと判定が安定します）
    $content    = isset($_POST['content'])    ? trim($_POST['content'])    : '';
    $choices    = isset($_POST['select'])     ? array_map('trim', $_POST['select']) : [];
    $choiceIdx  = isset($_POST['choice'])     ? (int)$_POST['choice'] : null; // 0,1,2 が入る想定
    $supplement = isset($_POST['supplement']) ? trim($_POST['supplement']) : '';

    // 2. バリデーション
    $content    = isset($_POST['content'])    ? trim($_POST['content'])    : '';
    // 2. 
    if ($content === '') {
        echo "問題文を入力してください。";
        exit;
    }

    if (empty($choices) || count($choices) < 3) {
        echo "選択肢は3つ以上入力してください。";
        exit;
    }

    // 全部空の選択肢は NG にする例（必要なら）
    foreach ($choices as $c) {
        if ($c === '') {
            echo "選択肢は空欄にしないでください。";
            exit;
        }
    }

    if ($choiceIdx === null) {
        echo "正解の選択肢を選んでください。";
        exit;
    }

    if (!array_key_exists($choiceIdx, $choices)) {
        echo "正解の選択肢の指定が不正です。";
        exit;
    }

    // 3. 画像アップロード処理
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = uniqid(mt_rand(), true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_path = dirname(__FILE__) . '/../../assets/img/quiz/' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_name = null;  // 画像がない場合はnullをセット
    }

    // 4. 質問をデータベースに挿入
    try {
        $stmt = $dbh->prepare("INSERT INTO questions (content, image, supplement) VALUES (?, ?, ?)");
        $stmt->execute([$content, $image_name, $supplement]);
        $problem_id = $dbh->lastInsertId(); // 新しく挿入した問題のIDを取得
    } catch (PDOException $e) {
        echo 'Error inserting question: ' . $e->getMessage();
        exit;
    }

    // 5. 選択肢をデータベースに挿入
    try {
        $stmt = $dbh->prepare("INSERT INTO choices (problem_id, name, valid) VALUES (?, ?, ?)");
        foreach ($choices as $index => $choiceText) {
            $valid = ($index === $choiceIdx) ? 1 : 0;  // 正解の選択肢かどうか
            $stmt->execute([$problem_id, $choiceText, $valid]);
        }
    } catch (PDOException $e) {
        echo 'Error inserting choice: ' . $e->getMessage();
        exit;
    }

    echo "保存しました";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/add.css">
    <title>問題一覧</title>
    <!-- <script src="../../assets/scripts/create.js" defer></script> -->
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
<!-- ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
これ以降がメインコンテンツ
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
        <section class="main_contents_2">
            <div>
                <h1>問題作成</h1>
            </div>
            <div class="form_area">
                <form action="" method="POST" enctype="multipart/form-data">
    <div class="space">
        <label for="content">問題文:</label><br>
        <input type="text" name="content" id="content" placeholder="問題文を入力してください">
    </div>
    <div class="space">
        <label for="select">選択肢:</label><br>
        <input type="text" name="select[]" id="select" placeholder="選択肢1を入力してください">
        <input type="text" name="select[]" id="select" placeholder="選択肢2を入力してください">
        <input type="text" name="select[]" id="select" placeholder="選択肢3を入力してください">
    </div>
    <div class="space">
        <label for="choice">正解の選択肢</label><br>
        <div class="radio-option">
            <input type="radio" id="option1" name="choice" id="choice" value="0">
            <label for="option1">選択肢1</label>
        </div>
        <div class="radio-option">
            <input type="radio" id="option2" name="choice" id="choice" value="1">
            <label for="option2">選択肢2</label>
        </div>
        <div class="radio-option">
            <input type="radio" id="option3" name="choice" id="choice" value="2">
            <label for="option3">選択肢3</label>
        </div>
    </div>
    <div class="space">
        <label for="image">問題の画像</label><br>
        <input class="" type="file" name="image" id="image" accept="image/*">
    </div>
    <div class="space">
        <label for="supplement">補足:</label><br>
        <input type="text" name="supplement" id="supplement" placeholder="補足を入力してください">
    </div>
    <button type="submit" id="submit">作成</button>
</form>
            </div>
            <?php
// var_dump($valid);
var_dump($_POST['content']);
?>
        </section>
    </main>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</body>
</html>