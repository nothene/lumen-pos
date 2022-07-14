<?php

namespace App\Services;

use App\Models\PurchaseTransaction;
use App\Models\PurchaseTransactionDetail;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class PurchaseService {
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
            $disc_amount = ($d['qty'] * $d['price']) * (1.0 - $multiplier);
            $purchaseDetail->disc_amount = $disc_amount;
            $purchaseDetail->total = ($d['qty'] * $d['price']) * $multiplier;

            $sub_total += ($d['qty'] * $d['price']);
            $disc_amount_total += $disc_amount;

            $purchaseDetail->save();
        }

        $purchase = PurchaseTransaction::find($request->input('company_id'));

        $purchase->sub_total = $sub_total;
        $purchase->disc_amount = $disc_amount_total;
        $purchase->grand_total = $sub_total - $disc_amount_total;

        $purchase->notes = $request->input('notes');

        $purchase->update();

        return response($purchase, 200);
    }
}