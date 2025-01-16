<?php
require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

$dbh = db_connect();
$userRepository = new UserRepository($dbh);

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    // Sessionにユーザがセットされている場合はリダイレクト
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: /');
        exit;
    }
    // GETならログイン画面を表示
    echo $twig->render('LoginView.html.twig');
} elseif ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // emailとpasswordが送信されているかチェック
    if (!isset($data['email']) || !isset($data['password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request']);
        exit;
    }

    // emailからユーザを取得
    try {
        $user = $userRepository->findUserByEmail($data['email']);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }

    // パスワードが一致するかチェック
    if (!password_verify($data['password'], $user->password_hash)) {
        http_response_code(401);
        echo json_encode(['error' => 'Password does not match']);
        exit;
    }

    // ログイン成功
    session_start();
    $_SESSION['user'] = $user;

    http_response_code(200);
    echo json_encode(['redirect' => '/']);
}
