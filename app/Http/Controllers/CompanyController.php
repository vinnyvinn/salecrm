<?php

namespace App\Http\Controllers;

use App\Company;
use App\Lead;
use App\Prospect;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        if ($request->has('prospect_id')) {
            try {
                $prospect = Prospect::find($request->prospect_id);
            } catch(ModelNotFoundException $e) {
                    
            }
        }
        if ($request->has('lead_id')) {
            try {
                $lead = Lead::find($request->lead_id);
            } catch(ModelNotFoundException $e) {

            }
        }

        return view('companies.create', get_defined_vars());
    }

    public function store(Request $request)
    {
//        dd($request->prospect_id);
//         dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'industry' => 'required',
            'company_type' => 'required',
            'email' => 'required|email',
            'telephone' => 'sometimes',
            'phone' => 'required',
            'address_1' => 'required',
            'lat' => 'required',
            'lng' => 'required',
//            'kra_pin' => 'sometimes|regex:/^p\d{9}[a-z]$/',
//            'kra_pin' => 'required|regex:/^p\d{9}[a-z]$/',
            'address_2' => 'sometimes',
            'location' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'industry_id' => $request->industry,
            'company_type' => $request->company_type,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'phone' => $request->phone,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'kra_pin' => $request->kra_pin,
            'location' => $request->location,
            'creator_id' => $request->user()->id
        ];

        $company = Company::create($data);

        toast('Company created successfully', 'success', 'top-right');

        if ($request->has('prospect_id')) {
            $prospect = Prospect::find($request->prospect_id);
            if ((bool) $prospect) {
                $prospect->company_id = $company->id;
                $prospect->save();
                return redirect()->route('prospects.index');
            }
        }
        if ($request->has('lead_id')) {
            $lead = Lead::find($request->lead_id);
            if ((bool) $lead) {
                $lead->company_id = $company->id;
                $lead->save();
                return redirect()->route('leads.index');
            }
        }

        return redirect()->route('companies.show',$company->id);
    }

    public function show(Company $company)
    {
        return view('companies.show',get_defined_vars());
    }

    public function edit(Company $company)
    {
        return view('companies.edit',get_defined_vars());
    }

    public function update(Request $request, Company $company)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'industry' => 'required',
            'company_type' => 'required',
            'email' => 'required|email',
            'telephone' => 'sometimes',
            'phone' => 'required',
            'address_1' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'kra_pin' => 'required|regex:/^a\d{9}[a-z]$/',
            'address_2' => 'sometimes',
            'location' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'industry_id' => $request->industry,
            'company_type' => $request->company_type,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'phone' => $request->phone,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'kra_pin' => $request->kra_pin,
            'location' => $request->location,
            'creator_id' => $request->user()->id
        ];

        $company->update($data);

        toast('Company edited successfully', 'success', 'top-right');

        return redirect()->route('companies.show',$company->id);
    }

    public function destroy(Company $company)
    {
        //
    }
}
