<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Recipe;
use App\Services\ProductionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class ProductionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index($id = null){
        if($id == null){
            $production = Production::orderBy('ID')->get();
        }
        else{
            $production = Production::where('ID', $id)->get();
        }
        return response()->json($production, 200);
    }    

    public function create(Request $request, ProductionService $productionService){
        $this->validate($request, [
            'recipe_id' => 'required',
            'qty_produced' => 'required'
        ]);
        return $productionService->produce($request);
    }
}
