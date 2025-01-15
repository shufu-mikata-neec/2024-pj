<?php

class IncomeExpenditure
{
    public $user_id;
    public $in_out_id;
    public $category_id;
    public $amount;
    public $created_at;
    public $evidence_uuid;

    public function __construct(int $user_id, int $in_out_id, int $category_id, int $amount, string $created_at, string $evidence_uuid)
    {
        $this->user_id = $user_id;
        $this->in_out_id = $in_out_id;
        $this->category_id = $category_id;
        $this->amount = $amount;
        $this->created_at = $created_at;
        $this->evidence_uuid = $evidence_uuid;
    }
}
