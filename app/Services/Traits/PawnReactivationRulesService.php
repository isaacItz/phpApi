<?php

namespace App\Services\Traits;

use App\Models\PawnReactivationRule;
use App\DTOs\PawnReactivationRuleDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait PawnReactivationRulesService
{
    public function createRule(PawnReactivationRuleDTO $dto)
    {
        try {
            DB::beginTransaction();

            $data = [
                'store_id' => $dto->store_id,
                'merchandise_type' => $dto->merchandise_type,
                'loan_amount_min' => $dto->loan_amount_min,
                'loan_amount_max' => $dto->loan_amount_max,
                'auction_date_expired_min' => $dto->auction_date_expired_min,
                'auction_date_expired_max' => $dto->auction_date_expired_max,
                'user_request_auth' => $dto->user_request_auth,
                'user_response_auth' => $dto->user_response_auth,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('pawn_reactivation_rules')->insert($data);

            DB::commit();

            return ['data' => null, 'value' => 1, 'msg' => 'Regla creada correctamente'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear regla: ' . $e->getMessage());
            return ['data' => null, 'value' => 0, 'msg' => 'Error al crear la regla'];
        }
    }

    // Más funciones aquí:
    // - findByStore
    // - findByStoreAndType
    // - findByMinLoanOrAuction
    // - findByFields
    // - listAll
    // - deleteSoft
}