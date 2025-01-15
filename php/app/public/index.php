<?php
$requestUri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($requestUri, PHP_URL_PATH), '/');

switch ($path) {
    case 'login':
        require_once __DIR__ . '/../private/controller/login.php';
        break;
    
    default:
        require_once __DIR__ . '/../private/controller/error.php';
        break;
}
