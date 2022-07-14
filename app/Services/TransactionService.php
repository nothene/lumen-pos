<?php

namespace App\Services;

use App\Models\ProductOnhand;
use App\Models\PurchaseTransaction;
use App\Models\PurchaseTransactionDetail;
use App\Models\SellTransaction;
use App\Models\SellTransactionDetail;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class TransactionService {
    function sell(Request $request, PriceService $priceService){
        $sell = new SellTransaction;

        $sell->company_id = $request->input('company_id');
        $sell->transaction_date = Carbon::parse($request->input('transaction_date'));
        $sell->customer_name = $request->input('customer_name');

        echo $request->input . "\n";

        if($request->input('is_cancelled') != null){
            $sell->is_cancelled = $request->input('is_cancelled');
            if($request->input('is_cancelled') == true){
                $sell->cancelled_at = $request->input('cancelled_at');
            }
        }

        if($request->input('is_printed') != null){
            $sell->is_printed = $request->input('is_printed');
            if($request->input('is_printed') == true){
                $sell->printed_at = $request->input('printed_at');
            }
        }        

        $sell->save();

        $details = $request->input('details');

        $sub_total = 0;
        $disc_amount_total = 0;

        foreach($details as $d){
            $sellDetail = new SellTransactionDetail;
            $sellDetail->sell_transaction_id = $sell->ID;
            $sellDetail->product_id = $d['product_id'];
            $sellDetail->qty = $d['qty'];

            // add to onhands qty
            $onhands = ProductOnhand::where('product_id', $d['product_id'])
                        ->where('company_id', $request->input('company_id'))->first();

            //echo $onhands . "\n";

            if($onhands == null){
                $onhands = new ProductOnhand;
                $onhands->product_id = $d['product_id'];
                $onhands->company_id = $request->input('company_id');
                $onhands->qty = -$sellDetail->qty;
                $onhands->save();
            } else {
                $onhands->qty = $onhands->qty - $sellDetail->qty;
                $onhands->update();
            }

            $curPrice = $priceService->getPriceAtTime($request->input('company_id'), $d['product_id'], Carbon::parse($request->input('transaction_date')))->price;
            
            if($curPrice == null){
                $curPrice = $priceService->getLatestPrice($request->input('company_id'), $d['product_id'])->price;
            }

            $sellDetail->price = $curPrice;
            $multiplier = 1.0;
            if(array_key_exists('disc_1', $d) && $d['disc_1']){
                $sellDetail->disc_1 = $d['disc_1'];
                $multiplier *= (1.0 - $sellDetail->disc_1);
            }

            if(array_key_exists('disc_2', $d) && $d['disc_2']){
                $sellDetail->disc_2 = $d['disc_2'];
                $multiplier *= (1.0 - $sellDetail->disc_2);
            }
            
            $disc_amount = ($d['qty'] * $curPrice) * (1.0 - $multiplier);
            $sellDetail->disc_amount = $disc_amount;
            $sellDetail->total = (($d['qty'] * $curPrice) * $multiplier);

            $sub_total += ($d['qty'] * $curPrice);
            $disc_amount_total += $disc_amount;

            $sellDetail->save();
        }

        $sell->sub_total = $sub_total;
        $sell->disc_amount = $disc_amount_total;
        $sell->grand_total = $sub_total - $disc_amount_total;

        $sell->notes = $request->input('notes');

        $sell->update();

        return response($sell, 200);        
    }

    function purchase(Request $request){
        $purchase = new PurchaseTransaction;

        $purchase->company_id = $request->input('company_id');
        $purchase->transaction_date = Carbon::parse($request->input('transaction_date'));
        $purchase->supplier_name = $request->input('supplier_name');

        if($request->input('is_cancelled') != null){
            $purchase->is_cancelled = $request->input('is_cancelled');
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
            
            // manually set price for material price
            // or read from database -> currently does not store raw material prices
            // do we store supplier as company
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