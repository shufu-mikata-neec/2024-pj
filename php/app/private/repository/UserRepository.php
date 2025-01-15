<?php

require_once __DIR__ . '../model/User.php';

class UserRepository
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function findUserByEmail(string $email) : User {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            throw new Exception('ユーザが見つかりません');
        }
        if (!isset($user['password_reset_token'])) {
            $user['password_reset_token'] = null;
        }
        if (!isset($user['password_reset_token_expiration'])) {
            $user['password_reset_token_expiration'] = null;
        }

        return new User($user['id'], $user['name'], $user['email'], $user['password_hash'], $user['screen_name'], $user['password_reset_token'], $user['password_reset_token_expiration']);
    }

}
