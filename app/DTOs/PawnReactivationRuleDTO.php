<?php 
// app/DTOs/PawnReactivationRuleDTO.php

namespace App\DTOs;

class PawnReactivationRuleDTO
{
    public int $store_id;
    public string $merchandise_type;
    public float $loan_amount_min;
    public ?float $loan_amount_max;
    public ?int $auction_date_expired_min;
    public ?int $auction_date_expired_max;
    public int $user_request_auth;
    public int $user_response_auth;

    public function __construct(array $data)
    {
        $this->store_id = $data['store_id'];
        $this->merchandise_type = $data['merchandise_type'];
        $this->loan_amount_min = $data['loan_amount_min'];
        $this->loan_amount_max = $data['loan_amount_max'] ?? null;
        $this->auction_date_expired_min = $data['auction_date_expired_min'] ?? null;
        $this->auction_date_expired_max = $data['auction_date_expired_max'] ?? null;
        $this->user_request_auth = $data['user_request_auth'];
        $this->user_response_auth = $data['user_response_auth'];
    }
}
?>