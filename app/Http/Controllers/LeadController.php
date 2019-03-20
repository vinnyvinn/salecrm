<?php

namespace App\Http\Controllers;

use App\Company;
use App\Firebase\FirebaseHelper;
use App\Lead;
use App\Mail\EmailOnActionComplete;
use App\User;
use Illuminate\Http\Request;
use Mail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Lead;
        $query = $model->newQuery();
        $leads = $query->where('stage','!=',config('sales-constants.post-lead'))->get();
        return view('leads.index', get_defined_vars());
    }

    public function create()
    {
        $system_users = User::all();
        return view('leads.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $rules = [
            'lead_owner' => 'required',
            'name'  => 'required',
            'email' => 'required|email',
            'assignee' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'country' => 'required',
        ];

        if ($request->has('company_set')) {
            [
                $rules['company_name'] = 'required',
                $rules['industry'] = 'required',
                $rules['company_email'] = 'required|email',
                $rules['company_telephone'] = 'sometimes',
                $rules['company_phone'] = 'required',
                $rules['company_address_1'] = 'required',
                $rules['lat'] = 'required',
                $rules['lng'] = 'required',
                $rules['kra_pin'] = 'required',
                $rules['company_location'] = 'required',
                $rules['company_type'] = 'required'
            ];
        }

        $this->validate($request, $rules);

        if ($request->has('company_set')) {
            $kampuni = [
                'name' => $request->company_name,
                'industry_id' => $request->industry,
                'creator_id' => $request->user()->id,
                'email' => $request->company_email,
                'telephone' => $request->company_telephone,
                'phone' => $request->company_phone,
                'address_1' => $request->company_address_1,
                'address_1' => $request->company_address_2,
                'lat' =>  $request->lat,
                'lng' =>  $request->lng,
                'kra_pin' => $request->kra_pin,
                'location' => $request->company_location,
                'company_type' => $request->company_type
            ];

            $company = Company::create($kampuni);
        }

        $data = [
            'creator_id' => $request->user()->id,
            'owner_id' => $request->lead_owner,
            'assignee_id' => $request->assignee,
            'title' => $request->title,
            'company_id' => isset($company) ? $company->id : null ,
            'name' => $request->name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'country' => $request->country,
        ];

        $lead = Lead::create($data);
        //send mail
        $title = config('messages.email_lead_title');
        $body = config('messages.email_lead_body');
        $name = $lead->name;
        Mail::to([$lead->email,$lead->assignee->email,$lead->creator->email])->send((new EmailOnActionComplete($title,$body,$name)));

//        $title = config('messages.push_lead_title');
//        $message = config('messages.push_lead_body');
//        $description = "Name:$request->name, \n Phone:$request->phone";
//        FirebaseHelper::sendFirebasePaymentNotification($title,$message,(new User)->firebaseID($request->assignee),$description);

        toast("Lead $lead->name added", 'success', 'top-right');

        return redirect('leads');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return view('leads.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        $system_users = User::all();
        return view('leads.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {

        $this->validate($request, [
            'lead_owner' => 'required',
            'name'  => 'required',
            'assignee' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        $lead->creator_id = $request->user()->id;
        $lead->assignee_id = $request->lead_owner;
        $lead->title = $request->title;
        $lead->name = $request->name;
        $lead->job_title = $request->job_title;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->description = $request->description;
        $lead->address_1 = $request->address_1;
        $lead->address_2 = $request->address_2;
        $lead->city = $request->city;
        $lead->country = $request->country;
        $lead->save();

        toast("lead $lead->name update", 'success', 'top-right');

        return redirect('leads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->trashed = true;
        $lead->save();
        toast("lead deleted", "success", "top-right");
        return response()->json([
            'status' => 'success'
        ]);
    }
}
