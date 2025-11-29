<?php
$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo 'Connection to DB';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// SQL ステートメント
$sql = 'SELECT * FROM questions';
$sql2 = 'SELECT * FROM choices';

// テーブル内のレコードを順番に出力
foreach ($dbh->query($sql) as $row) {
  echo $row['content'];
  echo $row['image'];
  echo $row['supplement'];
};

foreach ($dbh->query($sql2) as $row) {
  echo $row['id'];
  echo $row['problem_id'];
  echo $row['name'];
}

// =====================================================

$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $qKey => $question) {
    $question["choices"] = [];
    foreach ($choices as $cKey => $choice) {
        if ($choice["problem_id"] == $question["id"]) {
            $question["choices"][] = $choice;
        }
    }
    $questions[$qKey] = $question;
}

// var_dump($questions);  
// ↑確認できました。