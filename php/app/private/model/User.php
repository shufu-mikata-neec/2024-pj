<?php

class user
{
    public $id;
    public $email;
    public $password_hash;
    public $screen_name;
    public $password_reset_token;
    public $password_reset_toke_expiration;

    public function __construct(int $id, string $email, string $password_hash, string $screen_name, string $password_reset_token, string $password_reset_toke_expiration)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->screen_name = $screen_name;
        $this->password_reset_token = $password_reset_token;
        $this->password_reset_toke_expiration = $password_reset_toke_expiration;
    }
}
