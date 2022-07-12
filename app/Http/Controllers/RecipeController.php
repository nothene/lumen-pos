<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class RecipeController extends Controller
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
            $recipes = Recipe::orderBy('ID')->get();
        }
        else{
            $recipes = Recipe::where('ID', $id)->get();
        }
        return response()->json($recipes, 200);
    }    

    public function create(Request $request){
        //echo $request;

        // echo PHP_EOL;

        $data = $request->all();

        foreach($data as $d){
            echo $d . PHP_EOL;
        }

        $this->validate($request, [
            'name' => ['required', 'unique:products'],
            'is_raw_material' => ['required'],
            'is_active' => ['required'],
        ]);

        $product = new Recipe;

        if($request->input('company_id')){
            $product->company_id = $request->input('company_id');
        }        
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->color = $request->input('color');
        $product->is_raw_material = $request->input('is_raw_material');
        $product->is_active = $request->input('is_active');
        $product->uom_name = $request->input('uom_name');
        $product->recipe_id = $request->input('recipe_id');

        $product->save();
            
        return response('Product created successfully', 200);
    }    

    public function delete($id){
        $product = Recipe::find($id);
        if(!$product){
            return response('Recipe is not found', 404);
        }
        $product->delete();

        return response('Recipe deleted'. 200);
    }     
    
    public function update(Request $request, $id){
        $product = Recipe::find($id);

        if(!$product){
            return response('Recipe is not found', 404);
        }

        $this->validate($request, [
            'name' => ['required'],
            'is_raw_material' => ['required'],
            'is_active' => ['required'],
        ]);

        $product->company_id = $request->input('company_id');
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->color = $request->input('color');
        $product->is_raw_material = $request->input('is_raw_material');
        $product->is_active = $request->input('is_active');
        $product->uom_name = $request->input('uom_name');
        $product->recipe_id = $request->input('recipe_id');

        $product->save();
    }

    public function getIngredient($id){
        $note =  Recipe::find($id)->notes;
        $ingredients = Recipe::find($id)->detail
            ->map(function ($i, $note) {
                return  [
                    "name" => $i->product->name,
                    "qty" => $i->qty_needed,
                    "uom_name" => $i->product->uom_name,
                ];
            });

        // $data = [];

        // foreach($ingredients as $i){
        //     $d = [
        //         "name" => $i->product->name,
        //         "qty" => $i->qty_needed,
        //         "uom_name" => $i->product->uom_name,
        //         ];
        //     array_push($data, $d);
        // }

        // array_map(function($i) {
        //     echo $i;
        // }, $ingredients);

        return response([
            "ingredients" => $ingredients, 
            "notes" => $note
        ], 200);
    }
}
