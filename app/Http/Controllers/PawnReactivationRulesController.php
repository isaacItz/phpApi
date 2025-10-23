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


    // Otras funciones: index(), show(), delete(), update(), etc.
}
