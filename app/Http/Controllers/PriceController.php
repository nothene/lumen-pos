<?php

namespace App\Http\Controllers;

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

    public function create(Request $request, PriceService $priceService, $id){
        echo $id;
        $this->validate($request, [
            'company_id' => 'required',
            'product_id' => 'required',
            'published_at' => 'required',
            'price' => 'required',
        ]);
        return $priceService->publish($request);
    }

    public function index(PriceService $priceService, $cId, $pId){
        return $priceService->getCurrentPrice($cId, $pId);
    }
}