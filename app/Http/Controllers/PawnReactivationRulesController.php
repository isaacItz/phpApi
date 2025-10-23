<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Traits\PawnReactivationRulesService;

class PawnReactivationRulesController extends Controller
{
    use PawnReactivationRulesService;

    public function store(Request $request)
    {
        //dd($request);
        try {
            $data = $request->only([
                'store_id',
                'merchandise_type',
                'loan_amount_min',
                'loan_amount_max',
                'auction_date_expired_min',
                'auction_date_expired_max',
                'user_request_auth',
                'user_response_auth'
            ]);
            $response = $this->createRule($data);

            return response()->json($response, 200);

        } catch (\Exception $e) {
            \Log::error('Error en create: ' . $e->getMessage());

            return response()->json([
                'Data' => [],
                'Value' => 0,
                'Msg' => 'Ocurrió un error al crear la regla.'
            ], 500);
    }

    }
    public function index(Request $request)
    {
        return response()->json(['message' => 'Funciona', 'data' => $request->all()]);
    }

    public function findByStore(int $storeId)
    {
        return response()->json($this->findByStoreId($storeId));
    }

    public function searchByFields(Request $request)
    {
        try {
            // Tomamos todos los query params
            $filters = $request->query();

            // Llamamos al Trait con todos los filtros dinámicos
            $response = $this->findByFields($filters);

            return response()->json($response, 200);

        } catch (\Exception $e) {
            \Log::error('Error en PawnReactivationRuleController::search: ' . $e->getMessage());

            return response()->json([
                'Data' => [],
                'Value' => 0,
                'Msg' => 'Ocurrió un error al procesar la solicitud.'
            ], 500);
        }
    }

    public function findByMinLoanOrAuction(Request $request)
    {
        try {
            $filters = $request->query();
            $response = $this->searchByMinLoanOrAuction($filters);
            return response()->json($response, 200);

        } catch (\Exception $e) {
            \Log::error('Error en PawnReactivationRuleController::findByMinLoanOrAuction'. $e->getMessage());

            return response()->json([
                'Data' => [],
                'Value' => 0,
                'Msg' => 'Ocurrió un error al procesar la solicitud.'
            ], 500);
        }
    }
    // Otras funciones: index(), show(), delete(), update(), etc.
}
