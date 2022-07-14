<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTransaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Throwable;

class PurchaseController extends Controller
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
        $purchaseDetail = PurchaseTransaction::find($id)->details;
        return response()->json($purchaseDetail, 200);
    }        

    public function index(){
        $purchase = PurchaseTransaction::orderBy('ID')->get();
        return response()->json($purchase, 200);
    }    

    public function create(Request $request, TransactionService $transaction){
        //echo $request . "\n";
        $this->validate($request, [
            'company_id' => 'required',
            'transaction_date' => 'required',
            'supplier_name' => 'required',
            "details" => 'required'
        ]);

        return $transaction->purchase($request);
    }
}
