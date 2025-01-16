<?php
require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

$dbh = db_connect();
$userRepository = new UserRepository($dbh);

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    // GETならログイン画面を表示
    echo $twig->render('LoginView.html.twig');
} elseif ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    http_response_code(200);
    echo json_encode($data);
}
