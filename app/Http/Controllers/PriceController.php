<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PriceService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request){
        $this->validate($request, [
            'company_id' => 'required',
            'product_id' => 'required',
            'published_at' => 'required',
            'price' => 'required',
        ]);
        return response($this->service->publish($request), 200);
    }

    public function index(Request $request){
        $price = null;
        if($request->input('company_id') && $request->input('product_id')){
            $price = $this->service->getLatestPrice($request->input('company_id'), $request->input('product_id'));
        } else if($request->input('product_id')){
            $price = ProductPrice::where('product_id', $request->input('product_id'))->get();
        } else if($request->input('company_id')){
            $price = ProductPrice::where('company_id', $request->input('company_id'))->get();
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