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
        // carbon y-m-d h:m:s
        // utc +7 store in utc+0
        // assume input is +7
        $newProductPrice->published_at = Carbon::parse($request->input('published_at'))->subHours(7);        

        $newProductPrice->save(); 

        return response($newProductPrice, 200);
    }

    function getLatestPrice($company_id, $product_id){
        // published at must be earlier than now
        $curProductPrice = ProductPrice::where('company_id', $company_id)
                        ->where('product_id', $product_id)
                        ->where('published_at', '<=', Carbon::now())
                        ->orderBy('published_at', 'desc')
                        ->first();

        return $curProductPrice;
    }

    function getPriceAtTime($company_id, $product_id, Carbon $dateTime){
        // published at must be earlier than now
        $curProductPrice = ProductPrice::where('company_id', $company_id)
                        ->where('product_id', $product_id)
                        ->where('published_at', '<=', $dateTime)
                        ->orderBy('published_at', 'desc')
                        ->first();

        return $curProductPrice;
    }
}