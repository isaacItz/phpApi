<?php

namespace App\Services\Traits;

use App\Models\PawnReactivationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait PawnReactivationRulesService
{
    public function createRule(array $data)
    {
        DB::beginTransaction();
        try {

            $rule = new PawnReactivationRule();

            $rule->store_id = $data['store_id'];
            $rule->merchandise_type = $data['merchandise_type'];
            $rule->loan_amount_min = $data['loan_amount_min'];
            $rule->loan_amount_max = $data['loan_amount_max'] ?? null;
            $rule->auction_date_expired_min = $data['auction_date_expired_min'] ?? null;
            $rule->auction_date_expired_max = $data['auction_date_expired_max'] ?? null;
            $rule->user_request_auth = $data['user_request_auth'];
            $rule->user_response_auth = $data['user_response_auth'];
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
            Log::debug("hhola ");
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
            Log::error('Error al buscar reglas por sucursal: ' . $e->getMessage());

            return [
                'data' => [],
                'value' => 0,
                'msg' => 'Error al realizar la búsqueda. Consulte el log para más detalles.',
            ];
        }
    }

    public function findByFields(array $filters)
    {
        try {
            $query = PawnReactivationRule::query();

            // Iteramos sobre cada campo enviado y aplicamos el where dinámico
            foreach ($filters as $field => $value) {
                // Solo aplicamos a columnas válidas de la tabla
                if (
                    in_array($field, [
                        'store_id',
                        'merchandise_type',
                        'loan_amount_min',
                        'loan_amount_max',
                        'auction_date_expired_min',
                        'auction_date_expired_max',
                        'user_request_auth',
                        'user_response_auth'
                    ])
                ) {
                    $query->where($field, $value);
                }
            }

            $rules = $query->get();

            if ($rules->isEmpty()) {
                return [
                    'Data' => [],
                    'Value' => 0,
                    'Msg' => 'No se encontraron reglas con los campos especificados.'
                ];
            }

            return [
                'Data' => $rules,
                'Value' => 1,
                'Msg' => 'Búsqueda realizada correctamente.'
            ];

        } catch (\Exception $e) {
            \Log::error('Error en Trait::findByFields: ' . $e->getMessage());

            return [
                'Data' => [],
                'Value' => 0,
                'Msg' => 'Ocurrió un error al realizar la búsqueda.'
            ];
        }
    }
    
    public function searchByMinLoanOrAuction(array $filters)
    {
        try {
          
            $query = PawnReactivationRule::query();

            // Iteramos sobre cada campo enviado y aplicamos el where dinámico
            foreach ($filters as $field => $value) {
                // Solo aplicamos a columnas válidas de la tabla
                if (
                    in_array($field, [
                        'loan_amount_min',
                        'auction_date_expired_min'
                    ])
                ) {
                    $query->where($field, ">=", $value);
                    \Log::debug($query->toSql());
                }
            }
            $results = $query->get();
            
            if ($results->isEmpty()) {
                return [
                    'Data' => [],
                    'Value' => 0,
                    'Msg' => 'No se encontraron reglas con los campos especificados.'
                ];
            }
            return [
                'Data' => $results,
                'Value' => 0,
                'Msg' => 'Búsqueda realizada correctamente'
            ];


        } catch (\Exception $e) {
            \Log::error('Error en Trait::findByMinLoanOrAuction: ' . $e->getMessage());

            return [
                'Data' => [],
                'Value' => 0,
                'Msg' => 'Ocurrió un error al realizar la búsqueda.'
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