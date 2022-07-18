<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Production;
use App\Models\ProductOnhand;
use Illuminate\Support\Carbon;

class ProductionService {
    // negative raw material value allowed
    // allow force production
    function produce(Request $request){
        $production = new Production;

        $production->company_id = $request->input('company_id');
        $production->production_date = $request->input('production_date');
        $production->product_id = $request->input('product_id');

        if($request->input('recipe_id') == null){
            $production->recipe_id = $production->product->recipe_id;
        } else {
            $production->recipe_id = $request->input('recipe_id');
        }

        if($production->recipe_id == null){
            //echo 'Please set up the product to use a recipe first.';
            return response()->json('Please set up the product to use a recipe first.', 406);
        }   

        $product = $production->product;

        $production->product_id = $product->ID;     
        $production->qty_produced = $request->input('qty_produced');

        $productOnhand = $product->quantity()
                        ->where('company_id', $production->company_id)
                        ->where('product_id', $production->product_id)->first();

        $recipeDetail = $production->recipe->detail;

        //echo "Product name: " . $product->name . "\n";
        //echo "Company name: " . $production->company->name . "\n";

        // reduce raw material (product) quantity on company producing the product
        // need to check how many we can make with the available ingredient
        $forceProduction = true;
        $maxAmount = 1e10;

        // check max possible first
        foreach($recipeDetail as $d){
            $curProductOnhand = $d->product->quantity->where('company_id', $production->company_id)->first();
        
            $maxAmount = (int)max(0, min($maxAmount, $curProductOnhand->qty / $d->qty_needed));
            //echo "You can only make " . (int)($curProductOnhand->qty / $d->qty_needed) . " pcs max\n";
        }        

        //echo "Maximum with available ingredients: " . $maxAmount . "\n";

        foreach($recipeDetail as $d){
            $curProductOnhand = $d->product->quantity->where('company_id', $production->company_id)->first();
            //echo $d->product->name . "\n";
            //echo "------------------------\n";
            //echo "qnt on hand: " . $curProductOnhand->qty . " " . $d->product->uom_name . "\n";
            //echo "needed per pcs: " . $d->qty_needed . " " . $d->product->uom_name .  "\n";
            //echo "needed total: " . $d->qty_needed * $production->qty_produced . " " . $d->product->uom_name .  "\n";
            
            if($forceProduction){
                $curProductOnhand->qty = $curProductOnhand->qty - ($d->qty_needed * $production->qty_produced); 
            } else {
                $curProductOnhand->qty = $curProductOnhand->qty - ($d->qty_needed * $maxAmount); 
            }
            
            $curProductOnhand->save();

            //echo "Product qnt on hand after production: " . $curProductOnhand->qty . "\n";

            //echo "------------------------\n\n";
        }

        
        
        //echo $productOnhand; 

        if(!$productOnhand){
            $newProductOnhand = new ProductOnhand;
            $newProductOnhand->company_id = $production->company_id;
            $newProductOnhand->product_id = $production->product_id;

            if($forceProduction){
                //echo "qty on hand to be added: " . $production->qty_produced . "\n";
                $newProductOnhand->qty = $production->qty_produced;                
            } else {
                //echo "qty on hand to be added: " . $maxAmount . "\n";
                $newProductOnhand->qty = $maxAmount;
            }

            $newProductOnhand->save();
            //echo "New product onhand: " . $newProductOnhand . "\n";
        } else {
            //echo "\ncurrent qty on hand: " . $productOnhand->qty . "\n";

            if($forceProduction){
                //echo "qty on hand to be added: " . $production->qty_produced . "\n";
                $productOnhand->qty = $productOnhand->qty + $production->qty_produced; 
            } else {
                //echo "qty on hand to be added: " . $maxAmount . "\n";
                $productOnhand->qty = $productOnhand->qty + $maxAmount;                 
            }

            $productOnhand->save();
        }
        
        if(!$forceProduction){
            $production->qty_produced = $maxAmount;    
        }

        $production->save();        

        $msg = 'Production is forced. You can normally make at most ' . 
                $maxAmount . ' using available ingredients';
        
        if($forceProduction && $maxAmount < $request->input('qty_produced')){
            return response($msg, 200);
        } else {
            return response('Production all fine', 200);
        }
        
    }
}