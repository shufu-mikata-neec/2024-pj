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

    case 'logout':
        require_once __DIR__ . '/../private/controller/logout.php';
        break;
    case 'register':
        require_once __DIR__ . '/../private/controller/register.php';
        break;
    case 'register_finish':
        require_once __DIR__ . '/../private/controller/register_finish.php';
        break;
    case 'terms':
        require_once __DIR__ . '/../private/controller/terms.php';
        break;
    case 'add_income_expenditure':
        require_once __DIR__ . '/../private/controller/add_income_expenditure.php';
        break;
    default:
        require_once __DIR__ . '/../private/controller/error.php';
        break;
}
