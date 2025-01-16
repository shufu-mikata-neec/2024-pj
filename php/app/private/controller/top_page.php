<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/User.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);

session_start();

$data = [];

if (isset($_SESSION['user'])) {
    $data["name"] = $_SESSION['user']->screen_name;
}

echo $twig->render('TopView.html.twig', $data);
