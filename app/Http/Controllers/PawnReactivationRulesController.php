<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTOs\PawnReactivationRuleDTO;
use App\Models\PawnReactivationRule;
use App\Services\Traits\PawnReactivationRulesService;

class PawnReactivationRulesController extends Controller
{
    use PawnReactivationRulesService;

    public function store(Request $request)
    {
        //dd($request);

        return response()->json($this->createRule($request));
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


    // Otras funciones: index(), show(), delete(), update(), etc.
}
