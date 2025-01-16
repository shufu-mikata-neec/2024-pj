<?php

require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../../vendor/autoload.php';

session_start();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

$dbh = db_connect();
$userRepository = new UserRepository($dbh);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // ログイン済みならリダイレクト
    if (isset($_SESSION['user'])) {
        header('Location: /');
        exit;
    }
    echo $twig->render('MemberRegisterView.html.twig');
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // username、email、passwordが送信されているかチェック
    if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request']);
        exit;
    }

    // emailの形式チェック
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => ['email' => 'メールアドレスの形式が正しくありません']]);
        exit;
    }

    // emailからユーザを取得(登録済みならエラー)
    $user_exist = true;
    try {
        $user = $userRepository->findUserByEmail($data['email']);
    } catch (Exception $e) {
        $user_exist = false;
    }

    if ($user_exist) {
        http_response_code(400);
        echo json_encode(['error' => ['email' => 'このメールアドレスは既に登録されています']]);
        exit;
    }

    // ユーザ登録
    $user = $userRepository->createUser($data['email'], $data['password'], $data['username']);

    $_SESSION['user'] = $user;

    http_response_code(200);
    echo json_encode(['redirect' => '/register_finish']);
}
