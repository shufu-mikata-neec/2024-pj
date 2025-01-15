<?php

final class Subscription
{
    public $user_id;
    public $subscription_id;
    public $subscription_name;
    public $charge_date;

    public function __construct(int $user_id, int $subscription_id, string $subscription_name, string $charge_date)
    {
        $this->user_id = $user_id;
        $this->subscription_id = $subscription_id;
        $this->subscription_name = $subscription_name;
        $this->charge_date = $charge_date;
    }
}
