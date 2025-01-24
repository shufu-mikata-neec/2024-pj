<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

$dbh = db_connect();

$repo = new CategoryRepository($dbh);

check_login();

if ($_SERVER['REQUEST_METHOD'] === 'GET') { // GETリクエストの場合
    if (isset($_SESSION['add_category'])) {
        unset($_SESSION['add_category']);
        echo $twig->render('CategoryAddFinishedView.html.twig');
    } else {
        echo $twig->render('AddCategoryView.html.twig', [
            'uid' => $_SESSION['user']->id,
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTリクエストの場合
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // 必要な項目が入ってるかチェック
    if (
        !isset($data['name']) &&
        !isset($data['type']) &&
        !isset($data['uid'])
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request']);
        exit;
    }

    // データを挿入
    $category = $repo->create($data['uid'], $data['name'], $data['type']);

    // SESSIONに成功したことを保存
    $_SESSION['add_category'] = true;

    http_response_code(201);
}
