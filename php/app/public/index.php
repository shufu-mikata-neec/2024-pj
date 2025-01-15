<?php
$requestUri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($requestUri, PHP_URL_PATH), '/');

switch ($path) {
    case '':
        require_once __DIR__ . '/../private/controller/top_page.php';
        break;

    case 'login':
        require_once __DIR__ . '/../private/controller/login.php';
        break;
    
    default:
        require_once __DIR__ . '/../private/controller/error.php';
        break;
}
