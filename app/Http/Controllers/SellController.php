<?php

namespace App\Http\Controllers;

use App\Models\SellTransaction;
use App\Services\PriceService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Throwable;

class SellController extends Controller
{
    protected $transactionService;
    protected $priceService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionService $transactionService, PriceService $priceService)
    {
        $this->transactionService = $transactionService;
        $this->priceService = $priceService;
    }

    public function details($id){
        $sellDetail = SellTransaction::find($id)->details;
        return response()->json($sellDetail, 200);
    }        

    public function index(){
        $sell = SellTransaction::orderBy('ID')->get();
        return response()->json($sell, 200);
    }    

    public function create(Request $request){
        //echo $request . "\n";
        $this->validate($request, [
            'company_id' => 'required',
            'transaction_date' => 'required',
            'customer_name' => 'required',
            "details" => 'required'
        ]);

        return $this->transactionService->sell($request, $this->priceService);
    }
}
