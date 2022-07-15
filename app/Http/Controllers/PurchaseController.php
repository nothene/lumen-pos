<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTransaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Throwable;

class PurchaseController extends Controller
{
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function details($id){
        $purchaseDetail = PurchaseTransaction::find($id)->details;
        return response()->json($purchaseDetail, 200);
    }        

    public function index(){
        $purchase = PurchaseTransaction::orderBy('ID')->get();
        return response()->json($purchase, 200);
    }    

    public function create(Request $request){
        //echo $request . "\n";
        $this->validate($request, [
            'company_id' => 'required',
            'transaction_date' => 'required',
            'supplier_name' => 'required',
            "details" => 'required'
        ]);

        return $this->service->purchase($request);
    }
}
