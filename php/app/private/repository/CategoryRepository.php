<?php

require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../model/Category.php';

class CategoryRepository
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    function findCategoryByUserId(int $uid): array
    {
        $sql = 'SELECT * FROM category WHERE user_id = :uid AND is_deleted = 0';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($row['user_id'], $row['category_id'], $row['category_name'], $row['category_type'], $row['is_deleted']);
        }

        return $categories;
    }

    public function create(int $uid, string $name, int $type): Category
    {
        $this->dbh->beginTransaction();
        // 今の最大のカテゴリIDを取得(FOR UPDATEでロック)
        $sql = 'SELECT category_id FROM category WHERE user_id = :uid ORDER BY category_id DESC LIMIT 1 FOR UPDATE';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $category_id = ($row['category_id'] ?? 0) + 1;

        // カテゴリを追加
        $sql = 'INSERT INTO category (user_id, category_id, category_name, category_type, is_deleted) VALUES (:uid, :category_id, :name, :type, false)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->execute();

        $this->dbh->commit();

        return new Category($uid, $category_id, $name, $type);
    }
}
