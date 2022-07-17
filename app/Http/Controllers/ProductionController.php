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
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductionService $service)
    {
        $this->service = $service;
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

    public function create(Request $request){
        $this->validate($request, [
            'company_id' => 'required',
            'production_date' => 'required',
            // better to choose product than recipe
            // because product can only have one recipe
            //'recipe_id' => 'required',
            'product_id' => 'required',
            'qty_produced' => 'required'
        ]);
        return $this->service->produce($request);
    }
}
