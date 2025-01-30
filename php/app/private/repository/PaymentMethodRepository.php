<?php

require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../model/PaymentMethod.php';

class PaymentMethodRepository
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    function findPaymentMethodByUserId(int $uid): array
    {
        $sql = 'SELECT * FROM payment_method WHERE user_id = :uid';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $methods = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $methods[] = new PaymentMethod($row['user_id'], $row['payment_method_id'], $row['payment_method_name']);
        }

        return $methods;
    }

    public function create(int $uid, string $name): PaymentMethod
    {
        $this->dbh->beginTransaction();
        // 今の最大のカテゴリIDを取得(FOR UPDATEでロック)
        $sql = 'SELECT payment_method_id FROM payment_method WHERE user_id = :uid ORDER BY payment_method_id DESC LIMIT 1 FOR UPDATE';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $payment_method_id = ($row['payment_method_id'] ?? 0) + 1;

        // カテゴリを追加
        $sql = 'INSERT INTO payment_method (user_id, payment_method_id, payment_method_name) VALUES (:uid, :payment_method_id, :name)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
        $stmt->bindValue(':payment_method_id', $payment_method_id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $this->dbh->commit();

        return new PaymentMethod($uid, $payment_method_id, $name);
    }
}
