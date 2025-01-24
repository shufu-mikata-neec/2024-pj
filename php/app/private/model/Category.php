<?php

class Category
{
    public $user_id;
    public $category_id;
    public $category_name;
    public $category_type;
    public $is_deleted;

    public function __construct(int $user_id, int $category_id, string $category_name, string $category_type, bool $is_deleted = false)
    {
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_type = $category_type;
        $this->is_deleted = $is_deleted;
    }
}
