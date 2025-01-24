<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/../../vendor/autoload.php';

function is_login(): bool
{
    session_start();

    if (!isset($_SESSION['user'])) {
        return false;
    }
    return true;
}

function redirect_login(): void
{
    header('Location: /login');
    exit;
}

function check_login(): void
{
    if (!is_login()) {
        redirect_login();
    }
}
