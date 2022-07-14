<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeDetail;
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

    public function index(){
        $recipes = Recipe::orderBy('ID')->get();
        return response()->json($recipes, 200);
    }    

    public function create(Request $request){
        $this->validate($request, [
            'company_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'ingredients' => 'required',
            'notes' => 'required'
        ]);

        $recipe = new Recipe;

        $recipe->company_id = $request->input('company_id');
        $recipe->code = $request->input('code');
        $recipe->name = $request->input('name');
        $recipe->notes = $request->input('notes');

        $recipe->save();

        $ingredients = $request->input('ingredients');

        foreach($ingredients as $i){
            //echo $i['ID'] . " " . $i['qty'] . "\n";
            $ingredient = new RecipeDetail;
            $ingredient->recipe_id = $recipe->ID;
            $ingredient->product_id = $i['ID'];
            $ingredient->qty_needed = $i['qty'];

            $ingredient->save();
        }
            
        return response('Recipe created successfully', 200);
    }    

    public function delete($id){
        $product = Recipe::find($id);
        if(!$product){
            return response('Recipe is not found', 404);
        }
        $product->delete();

        return response('Recipe deleted'. 200);
    }     
    
    // handle details
    public function update(Request $request, $id){
        $this->validate($request, [
            'company_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'ingredients' => 'required',
            'notes' => 'required'
        ]);

        $recipe = Recipe::find($id);

        $recipe->company_id = $request->input('company_id');
        $recipe->code = $request->input('code');
        $recipe->name = $request->input('name');
        $recipe->notes = $request->input('notes');

        // use update
        // save creates a new record
        $recipe->update();

        $ingredients = $request->input('ingredients');

        foreach($ingredients as $i){
            //echo $i['ID'] . " " . $i['qty'] . "\n";
            $ingredient = RecipeDetail::updateOrCreate(
                [
                    'recipe_id' => $id,
                    'product_id' => $i['ID']
                ],
                ['qty_needed' => $i['qty']]
            );

            $ingredient->update();
        }
            
        return response('Recipe updated successfully', 200);
    }

    public function getIngredient($id){
        $note =  Recipe::find($id)->notes;
        $ingredients = Recipe::find($id)->detail
            ->map(function ($i, $note) {
                return  [
                    "ID" => $i->product->ID,
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

        return response($ingredients, 200);
    }
}

