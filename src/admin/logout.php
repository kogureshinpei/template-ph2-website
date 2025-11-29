<?php
session_start();

// セッションを破棄
session_unset();  // セッション変数をすべて解除
session_destroy();  // セッション自体を破棄

// signin.phpにリダイレクト
header('Location: index.php');
exit();
?>
