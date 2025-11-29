<?php
header('Content-Type: application/json; charset=utf-8');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = $_POST['id'] ?? null;

//     if (!$id || !is_numeric($id)) {
//         echo json_encode(['success' => false, 'message' => 'Invalid ID']);
//         exit;
//     }

//     try {
//         $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
//         $stmt->execute([$id]);
//         echo json_encode(['success' => true]);


// // エラーメッセージ確認用
// var_dump($_POST);
//     } catch (PDOException $e) {
//         // 外部キー制約エラーなどをキャッチ
//         echo json_encode(['success' => false, 'message' => $e->getMessage()]);

// // エラーメッセージ確認用
// var_dump($_POST);
//     }
// }

// // $pdo->prepare("DELETE FROM choices WHERE problem_id = ?")->execute([$id]);
// // $pdo->prepare("DELETE FROM questions WHERE id = ?")->execute([$id]);
// echo json_encode(['success' => true]);
//  ＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾
// $dsn = 'mysql:host=db;dbname=posse;charset=utf8';
// $user = 'root';
// $password = 'root';

// try {
//     $dbh = new PDO($dsn, $user, $password);
//     // 接続成功時
//     echo 'Connection to DB successful';
// } catch (PDOException $e) {
//     // 接続失敗時
//     echo 'Connection failed: ' . $e->getMessage();
//     exit;
// }

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
<?php
session_start();

// ログインチェック（任意だが本来はやるべき）
if (!isset($_SESSION['user_id'])) {
    header('Location: ../admin/auth/signin.php');
    exit();
}

$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// POST で delete_id が送られているか確認
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];

    try {
        // トランザクション開始（1文だけでも「お作法」としてやっておくと安心）
        $dbh->beginTransaction();

        // 親テーブルquestionsから削除
        // ON DELETE CASCADE により choices も一緒に消える
        $stmt = $dbh->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->execute([$delete_id]);

        $dbh->commit();

        // 削除後は一覧に戻す
        header('Location: ./index.php');
        exit;
    } catch (PDOException $e) {
        $dbh->rollBack();
        echo "削除中にエラーが発生しました: " . $e->getMessage();
        exit;
    }
} else {
    // 不正アクセス対策
    header('Location: ./index.php');
    exit;
}