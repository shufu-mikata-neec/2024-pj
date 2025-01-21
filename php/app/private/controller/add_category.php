<?php
require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

$dbh = db_connect();
$userRepository = new UserRepository($dbh);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

echo $twig->render('AddCategoryView.html.twig');