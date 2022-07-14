<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceController extends Controller
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

    public function create(Request $request, PriceService $priceService){
        $this->validate($request, [
            'company_id' => 'required',
            'product_id' => 'required',
            'published_at' => 'required',
            'price' => 'required',
        ]);
        return response($priceService->publish($request), 200);
    }

    public function index(Request $request, PriceService $priceService){
        if($request->input('company_id') && $request->input('product_id')){
            $price = $priceService->getLatestPrice($request->input('company_id'), $request->input('product_id'));
        } else {
            $price = ProductPrice::all();
        }
        
        return response($price, 200);
    }

    public function delete($id){
        $price = ProductPrice::find($id);
        $price->delete();
        return response('Price point deleted successfully', 200);
    }
}