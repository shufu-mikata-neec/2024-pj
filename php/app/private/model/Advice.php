<?php

class Advice
{
    public $user_id;
    public $advice_id;
    public $advice_type;
    public $created_at;
    public $report;
    public $content;

    public function __construct(int $user_id, int $advice_id, string $advice_type, string $created_at, string $report, string $content)
    {
        $this->user_id = $user_id;
        $this->advice_id = $advice_id;
        $this->advice_type = $advice_type;
        $this->created_at = $created_at;
        $this->report = $report;
        $this->content = $content;
    }
}
