<?php

namespace App\Services;

use App\Models\ProductOnhand;
use App\Models\PurchaseTransaction;
use App\Models\PurchaseTransactionDetail;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class TransactionService {
    function sell(Request $request){
        
    }

    function purchase(Request $request){
        $purchase = new PurchaseTransaction;

        $purchase->company_id = $request->input('company_id');
        $purchase->transaction_date = $request->input('transaction_date');
        $purchase->supplier_name = $request->input('supplier_name');

        if($request->input('is_cancelled') != null){
            $purchase->transaction_date = $request->input('is_cancelled');
        }

        $purchase->save();

        $details = $request->input('details');

        $sub_total = 0;
        $disc_amount_total = 0;

        foreach($details as $d){
            $purchaseDetail = new PurchaseTransactionDetail;
            $purchaseDetail->purchase_transaction_id = $purchase->ID;
            $purchaseDetail->raw_material_id = $d['raw_material_id'];
            $purchaseDetail->qty = $d['qty'];

            // add to onhands qty
            $onhands = ProductOnhand::where('product_id', $d['raw_material_id'])
                        ->where('company_id', $request->input('company_id'))->first();

            echo $onhands . "\n";

            if($onhands == null){
                $onhands = new ProductOnhand;
                $onhands->product_id = $d['raw_material_id'];
                $onhands->company_id = $request->input('company_id');
                $onhands->qty = $purchaseDetail->qty;
                $onhands->save();
            } else {
                $onhands->qty = $onhands->qty + $purchaseDetail->qty;
                $onhands->update();
            }

            $purchaseDetail->price = $d['price'];
            $multiplier = 1.0;
            if(array_key_exists('disc_1', $d) && $d['disc_1']){
                $purchaseDetail->disc_1 = $d['disc_1'];
                $multiplier *= (1.0 - $purchaseDetail->disc_1);
            }
            // assume disc 2 is calculated after applying disc 1
            if(array_key_exists('disc_2', $d) && $d['disc_2']){
                $purchaseDetail->disc_2 = $d['disc_2'];
                $multiplier *= (1.0 - $purchaseDetail->disc_2);
            }
            
            // need to check rounding?
            $disc_amount = ($d['qty'] * $d['price']) * (1.0 - $multiplier);
            $purchaseDetail->disc_amount = $disc_amount;
            $purchaseDetail->total = (($d['qty'] * $d['price']) * $multiplier);

            $sub_total += ($d['qty'] * $d['price']);
            $disc_amount_total += $disc_amount;

            $purchaseDetail->save();
        }

        echo "sub: " . $sub_total . " disc: " . $disc_amount_total . "\n";
        $purchase->sub_total = $sub_total;
        $purchase->disc_amount = $disc_amount_total;
        $purchase->grand_total = $sub_total - $disc_amount_total;

        $purchase->notes = $request->input('notes');

        $purchase->update();

        return response($purchase, 200);
    }
}