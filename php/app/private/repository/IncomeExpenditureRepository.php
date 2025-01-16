<?php

require_once __DIR__ . '/../model/IncomeExpenditure.php';
require_once __DIR__ . '/../model/User.php';

class IncomeExpenditureRepository
{
    private $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function findRowByUserIdAndInOutId(int $user_id, int $in_out_id): ?IncomeExpenditure
    {
        $stmt = $this->dbh->prepare('SELECT * FROM income_expenditure WHERE user_id = :user_id AND in_out_id = :in_out_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':in_out_id', $in_out_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return new IncomeExpenditure($row['user_id'], $row['in_out_id'], $row['category_id'], $row['amount'], $row['created_at'], $row['evidence_uuid']);
    }

    public function create(int $user_id, int $in_out_id, int $category_id, int $amount, string $created_at, ?string $evidence_uuid)
    {
        // トランザクション開始
        try {
            $this->dbh->beginTransaction();

            $stmt = $this->dbh->prepare('SELECT MAX(in_out_id) FROM income_expenditure WHWRE user_id = :user_id FOR UPDATE');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $maxId = $row['MAX(in_out_id)'] ?? 0;
            $in_out_id = $maxId + 1;
            $stmt = $this->dbh->prepare('INSERT INTO income_expenditure (user_id, in_out_id, category_id, amount, created_at, evidence_uuid) VALUES (:user_id, :in_out_id, :category_id, :amount, :created_at, :evidence_uuid)');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':in_out_id', $in_out_id, PDO::PARAM_INT);
            $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
            $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->bindValue(':evidence_uuid', $evidence_uuid, PDO::PARAM_STR);

            $stmt->execute();

            $this->dbh->commit();

            return $this->findRowByUserIdAndInOutId($user_id, $in_out_id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
