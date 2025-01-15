<?php
require_once __DIR__ . '/../core/DB.php';

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    # ログイン画面表示
    # include __DIR__ . '/../view/LoginView.php';
}


$dbh = db_connect();

$sql = 'SELECT * FROM user WHERE email = :email';
$email = 'hoge@example.com';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($user);
