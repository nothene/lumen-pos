<?php

namespace App\Http\Controllers;

use App\Models\SellTransaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Throwable;

class SellController extends Controller
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

    public function detail($id){
        $sellDetail = SellTransaction::find($id)->details;
        return response()->json($sellDetail, 200);
    }        

    public function index(){
        $sell = SellTransaction::orderBy('ID')->get();
        return response()->json($sell, 200);
    }    

    public function create(Request $request, TransactionService $transaction){
        //echo $request . "\n";
        $this->validate($request, [
            'company_id' => 'required',
            'transaction_date' => 'required',
            'customer_name' => 'required',
            "details" => 'required'
        ]);

        return $transaction->purchase($request);
    }
}
