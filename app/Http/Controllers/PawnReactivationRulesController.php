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
        $dto = new PawnReactivationRuleDTO($request->all());
        return response()->json($this->createRule($dto));
    }
    public function index(Request $request)
    {
        return response()->json(['message' => 'Funciona', 'data' => $request->all()]);
    }

    // Otras funciones: index(), show(), delete(), update(), etc.
}
