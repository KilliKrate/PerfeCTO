<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Company;
use App\Models\Type;
use App\Models\Ateco;
use App\Models\Address;
use App\Http\Resources\Company as CompanyResource;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get companies
        $companies = Company::paginate(15);

        // Return collection of companies as a resource
        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $company = Company::findOrFail($request->id);
        } else {
            $company = new Company([
                'business_name' => $request->input('business_name'),
                'n_employees' => $request->input('n_employees'),
                'contract_date' => $request->input('contract_date'),
                'type' => Type::where($request->input('type'), 'name')->firstOrFail()->id,
                'ateco' => Ateco::where($request->input('ateco'), 'code')->firstOrFail()->code,
                'address' => 1
            ]);
        }

        if ($company->save()) {
            return new CompanyResource($company);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get a single company
        $company = Company::findOrFail($id);

        // Return single company as a resource
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get a single company
        $company = Company::findOrFail($id);
        // Get the address of said company
        $address = Address::findOrFail($company->address);

        // Delete both and return the company if it was successful
        if ($company->delete() && $address->delete()) {
            return new CompanyResource($company);
        }
    }
}
