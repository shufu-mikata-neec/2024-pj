<?php

require_once __DIR__ . '/../model/User.php';

class UserRepository
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function findUserByEmail(string $email): User
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
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

        return new User($user['user_id'], $user['email'], $user['password_hash'], $user['screen_name'], $user['password_reset_token'], $user['password_reset_token_expiration']);
    }

    public function createUser(string $email, string $password, string $screen_name): User
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO user (email, password_hash, screen_name) VALUES (:email, :password_hash, :screen_name)';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':screen_name', $screen_name, PDO::PARAM_STR);
        $stmt->execute();

        return $this->findUserByEmail($email);
    }
}
