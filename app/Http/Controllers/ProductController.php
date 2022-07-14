<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
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

    public function details($id){
        $products = Product::find($id);
        $prices = Product::find($id)->prices;
        $quantity = Product::find($id)->quantity()->get();
        return response()->json([$products, $prices, $quantity], 200);
    }

    public function index(){
        $products = Product::orderBy('ID')->get();
        return response()->json([$products], 200);
    }    

    public function create(Request $request){
        $this->validate($request, [
            'name' => ['required', 'unique:products'],
            'is_raw_material' => ['required'],
            'is_active' => ['required'],
        ]);

        $product = new Product;

        if($request->input('company_id')){
            $product->company_id = $request->input('company_id');
        }        
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->color = $request->input('color');
        $product->is_raw_material = $request->input('is_raw_material');
        $product->is_active = $request->input('is_active');
        $product->uom_name = $request->input('uom_name');
        $product->recipe_id = $request->input('recipe_id');

        $product->save();
            
        return response('Product created successfully', 200);
    }    

    public function delete($id){
        $product = Product::find($id);
        if(!$product){
            return response('Product is not found', 404);
        }
        $product->delete();

        return response('Product deleted'. 200);
    }     
    
    public function update(Request $request, $id){
        $product = Product::find($id);

        if(!$product){
            return response('Product is not found', 404);
        }

        $this->validate($request, [
            'name' => ['required'],
            'is_raw_material' => ['required'],
            'is_active' => ['required'],
        ]);

        $product->company_id = $request->input('company_id');
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->color = $request->input('color');
        $product->is_raw_material = $request->input('is_raw_material');
        $product->is_active = $request->input('is_active');
        $product->uom_name = $request->input('uom_name');
        $product->recipe_id = $request->input('recipe_id');

        $product->update();
    }    
}
