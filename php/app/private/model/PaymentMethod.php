<?php

final class PaymentMethod
{
    public $user_id;
    public $payment_method_id;
    public $payment_method_name;

    public function __construct(int $user_id, int $payment_method_id, string $payment_method_name)
    {
        $this->user_id = $user_id;
        $this->payment_method_id = $payment_method_id;
        $this->payment_method_name = $payment_method_name;
    }
}
