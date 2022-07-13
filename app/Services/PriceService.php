<?php

namespace App\Services;

use App\Models\ProductPrice;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class PriceService {
    function publish(Request $request){
        $newProductPrice = new ProductPrice;
        $newProductPrice->company_id = $request->input('company_id');
        $newProductPrice->product_id = $request->input('product_id');
        $newProductPrice->price = $request->input('price');
        $newProductPrice->published_at = Carbon::parse($request->input('published_at'));

        echo Carbon::parse($request->input('published_at'));

        $newProductPrice->save();

        echo $newProductPrice;                        

        //getCurrentPrice($newProductPrice->company_id, $newProductPrice->product_id);

        return response($newProductPrice, 200);
    }

    function getCurrentPrice($company_id, $product_id){
        $curProductPrice = ProductPrice::where('company_id', $company_id)
                        ->where('product_id', $product_id);

        foreach($curProductPrice as $c){
            echo $c->published_at . "\n";
        }        
    }
}