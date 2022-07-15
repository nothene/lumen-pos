<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Throwable;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function details($id){
        $company = Company::find($id);
        return response()->json($company, 200);
    }        

    public function index(){
        $company = Company::orderBy('ID')->get();
        return response()->json($company, 200);
    }    

    public function create(Request $request){
        //echo $request . "\n";
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required'
        ]);

        $company = new Company;
        $company->name = $request->input('name');
        $company->address = $request->input('address');

        $company->save();

        return response('Product created', 200);
    }
}
