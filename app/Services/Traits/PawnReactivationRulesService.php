<?php

namespace App\Services\Traits;

use App\Models\PawnReactivationRule;
use App\DTOs\PawnReactivationRuleDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait PawnReactivationRulesService
{
    public function createRule(Request $dto)
    {
        DB::beginTransaction();
        try {
            
            $rule = new PawnReactivationRule();

            $rule->store_id = $dto->store_id;
            $rule->merchandise_type = $dto->merchandise_type;
            $rule->loan_amount_min = $dto->loan_amount_min;
            $rule->loan_amount_max = $dto->loan_amount_max;
            $rule->auction_date_expired_min = $dto->auction_date_expired_min;
            $rule->auction_date_expired_max = $dto->auction_date_expired_max;
            $rule->user_request_auth = $dto->user_request_auth;
            $rule->user_response_auth = $dto->user_response_auth;
            
            $rule->save(); 

            DB::commit();

            return ['data' => $rule, 'value' => 1, 'msg' => 'Regla creada correctamente'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear regla: ' . $e->getMessage());
            return ['data' => null, 'value' => 0, 'msg' => 'Error al crear la regla'];
        }
    }

    public function findByStoreId(int $storeId): array
{
    try {
        $rules = PawnReactivationRule::where('store_id', $storeId)->get();
        \Log::debug("hhola ");
        if ($rules->isEmpty()) {
            return [
                'data' => [],
                'value' => 0,
                'msg' => 'No se encontraron registros para la sucursal especificada.',
            ];
        }

        return [
            'data' => $rules,
            'value' => 1,
            'msg' => 'Consulta realizada correctamente.',
        ];

    } catch (\Exception $e) {
        \Log::error('Error al buscar reglas por sucursal: ' . $e->getMessage());

        return [
            'data' => [],
            'value' => 0,
            'msg' => 'Error al realizar la búsqueda. Consulte el log para más detalles.',
        ];
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