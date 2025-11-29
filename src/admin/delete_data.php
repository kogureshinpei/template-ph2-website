<?php
header('Content-Type: application/json; charset=utf-8');

// require 'db_connect.php'; // PDO接続を含むファイルを読み込む（例）

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);


// エラーメッセージ確認用
var_dump($_POST);
    } catch (PDOException $e) {
        // 外部キー制約エラーなどをキャッチ
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);

// エラーメッセージ確認用
var_dump($_POST);
    }
}

// $pdo->prepare("DELETE FROM choices WHERE problem_id = ?")->execute([$id]);
// $pdo->prepare("DELETE FROM questions WHERE id = ?")->execute([$id]);
echo json_encode(['success' => true]);
// ＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾＾
$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    // 接続成功時
    echo 'Connection to DB successful';
} catch (PDOException $e) {
    // 接続失敗時
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>