<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Company;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Mail\EmailOnActionComplete;
use App\Prospect;
use App\Transformers\ActivityTransformer;
use App\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        $model = new Customer();
        $query = $model->newQuery();

        $customers = $query->get();
        return view('customers.index',get_defined_vars());
    }

    public function create(Prospect $prospect)
    {
        if (Customer::where('prospect_id',$prospect->id)->first()){
            toast('Prospect already added to Customers', 'error', 'top-right');
            return back();
        }
        $companies = Company::all();
        $system_users = User::all();
        return view('customers.create', get_defined_vars());
    }

    public function store(CustomerRequest $request, Prospect $prospect)
    {
        if (Customer::where('prospect_id',$prospect->id)->first()){
            toast('Lead already added to prospects', 'error', 'top-right');
            return back();
        }
        $pin_cert = $this->uploadFiles($request->pin_cert);
        $vat_cert = $this->uploadFiles($request->vat_cert);
        $co_reg_cert = $this->uploadFiles($request->co_reg_cert);
        $rep_id_file = $this->uploadFiles($request->rep_id_file);
        $directors_list = $this->uploadFiles($request->directors_list);
        $utility_bill = $this->uploadFiles($request->utility_bill);

        $modes= array();
        $boxes = $request->payment_mode;
        foreach ($boxes as $box) {
            $modes[] = $box;
        }
        $payment_mode = implode(',',$modes);
        $data = [
            'name' => $prospect->lead->name,
            'title' => $prospect->lead->title,
            'job_title' => $prospect->lead->job_title,
            'email' => $prospect->lead->email,
            'phone' => $prospect->lead->phone,
            'description' => $prospect->lead->description,
            'address_1' => $prospect->lead->address_1,
            'address_2' => $prospect->lead->address_2,
            'country' => $prospect->lead->country,
            'city' => $prospect->lead->city,
            'owner_id' => $prospect->lead->owner_id,
            'creator_id' => $request->user()->id,
            'prospect_id' => $prospect->id,
            'assignee_id' => $request->assigned_to,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'bank_telephone' => $request->bank_telephone,
            'bank_branch' => $request->bank_branch,
            'bank_code' => $request->bank_code,
            'swiftcode' => $request->swiftcode,
            'bank_account_no' => $request->bank_account_no,
            'payment_date' => $request->payment_date,
            'payment_mode' => $payment_mode,
            'currency' => $request->currency,
            'co_name_1' => $request->co_name_1,
            'co_contact_name_1' => $request->co_contact_name_1,
            'co_address_1' => $request->co_address_1,
            'co_city_1' => $request->co_city_1,
            'co_postcode_1' => $request->co_postcode_1,
            'co_phone_1' => $request->co_phone_1,
            'co_email_1' => $request->co_email_1,
            'co_comment_1' => $request->co_comment_1,
            'co_name_2' => $request->co_name_2,
            'co_contact_name_2' => $request->co_contact_name_2,
            'co_address_2' => $request->co_address_2,
            'co_city_2' => $request->co_city_2,
            'co_postcode_2' => $request->co_postcode_2,
            'co_phone_2' => $request->co_phone_2,
            'co_email_2' => $request->co_email_2,
            'co_comment_2' => $request->co_comment_2,
            'terms' => 'on',
            'pin_cert' => $pin_cert,
            'vat_cert' => $vat_cert,
            'co_reg_cert' => $co_reg_cert,
            'rep_id_file' => $rep_id_file,
            'directors_list' => $directors_list,
            'utility_bill' => $utility_bill,
            'total_turnover_1' => $request->total_turnover_1,
            'total_assets_1' => $request->total_assets_1,
            'current_assets_1' => $request->current_assets_1,
            'total_liabilities_1' => $request->total_liabilities_1,
            'current_liabilities_1' => $request->current_liabilities_1,
            'profit_before_taxes_1' => $request->profit_before_taxes_1,
            'profit_after_taxes_1' => $request->profit_after_taxes_1,
            'total_turnover_2' => $request->total_turnover_2,
            'total_assets_2' => $request->total_assets_2,
            'current_assets_2' => $request->current_assets_2,
            'total_liabilities_2' => $request->total_liabilities_2,
            'current_liabilities_2' => $request->current_liabilities_2,
            'profit_before_taxes_2' => $request->profit_before_taxes_2,
            'profit_after_taxes_2' => $request->profit_after_taxes_2,
            'company_id' => $prospect->company_id
        ];
//        dd($data);
        $customer = Customer::create($data);
        $prospect->stage = config('sales-constants.post-prospect');
        $prospect->status = config('sales-constants.won');
        $prospect->save();
        //sendmail
        $title = config('messages.email_customer_title');
        $body = config('messages.email_customer_body');
        $name = $prospect->lead->name;
        Mail::to([$prospect->lead->email,$customer->assignee->email,$customer->creator->email])->send((new EmailOnActionComplete($title,$body,$name)));
        toast('Prospect added to Customers', 'success', 'top-right');

        return redirect()->route('customer.index');
    }

    public function uploadFiles($file){
        $filename = time().str_replace(' ','-',$file->getClientOriginalName());
        $file->move(
            public_path() . '/files/customer/', $filename
        );
        $path = '/files/customer/'. $filename;
        return $path;
    }

    public function show(Customer $customer)
    {
        $activities = $customer->activities()
            ->orderBy('deadline', 'desc')
            ->take(5)
            ->get();
        $users = User::all();
        return view('customers.show', get_defined_vars());
    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();
        $system_users = User::all();
        return view('customers.edit', get_defined_vars());
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $data = [];
        if ($request->pin_cert != null) {
            $pin_cert = $this->uploadFiles($request->pin_cert);
            File::delete(public_path(). $customer->pin_cert);
            $data['pin_cert'] = $pin_cert;
        }
        if ($request->vat_cert != null) {
            $vat_cert = $this->uploadFiles($request->vat_cert);
            File::delete(public_path(). $customer->vat_cert);
            $data['vat_cert'] = $vat_cert;
        }
        if ($request->co_reg_cert != null) {
            $co_reg_cert = $this->uploadFiles($request->co_reg_cert);
            File::delete(public_path(). $customer->co_reg_cert);
            $data['co_reg_cert'] = $co_reg_cert;
        }
        if ($request->rep_id_file != null) {
            $rep_id_file = $this->uploadFiles($request->rep_id_file);
            File::delete(public_path(). $customer->rep_id_file);
            $data['rep_id_file'] = $rep_id_file;
        }
        if ($request->directors_list != null) {
            $directors_list = $this->uploadFiles($request->directors_list);
            File::delete(public_path(). $customer->directors_list);
            $data['directors_list'] = $directors_list;
        }
        if ($request->utility_bill != null) {
            $utility_bill = $this->uploadFiles($request->utility_bill);
            File::delete(public_path(). $customer->utility_bill);
            $data['utility_bill'] = $utility_bill;
        }

        $modes= array();
        $boxes = $request->payment_mode;
        foreach ($boxes as $box) {
            $modes[] = $box;
        }
        $payment_mode = implode(',',$modes);

        $data['creator_id'] = $request->user()->id;
            $data['assignee_id'] = $request->assigned_to;
            $data['bank_name'] = $request->bank_name;
            $data['bank_address'] = $request->bank_address;
            $data['bank_telephone'] = $request->bank_telephone;
            $data['bank_branch'] = $request->bank_branch;
            $data['bank_code'] = $request->bank_code;
            $data['swiftcode'] = $request->swiftcode;
            $data['bank_account_no'] = $request->bank_account_no;
            $data['payment_date'] = $request->payment_date;
            $data['payment_mode'] = $payment_mode;
            $data['currency'] = $request->currency;
            $data['co_name_1'] = $request->co_name_1;
            $data['co_contact_name_1'] = $request->co_contact_name_1;
            $data['co_address_1'] = $request->co_address_1;
            $data['co_city_1'] = $request->co_city_1;
            $data['co_postcode_1'] = $request->co_postcode_1;
            $data['co_phone_1'] = $request->co_phone_1;
            $data['co_email_1'] = $request->co_email_1;
            $data['co_comment_1'] = $request->co_comment_1;
            $data['co_name_2'] = $request->co_name_2;
            $data['co_contact_name_2'] = $request->co_contact_name_2;
            $data['co_address_2'] = $request->co_address_2;
            $data['co_city_2'] = $request->co_city_2;
            $data['co_postcode_2'] = $request->co_postcode_2;
            $data['co_phone_2'] = $request->co_phone_2;
            $data['co_email_2'] = $request->co_email_2;
            $data['co_comment_2'] = $request->co_comment_2;
//            $data['terms'] = $request->terms;
            $data['total_turnover_1'] = $request->total_turnover_1;
            $data['total_assets_1'] = $request->total_assets_1;
            $data['current_assets_1'] = $request->current_assets_1;
            $data['total_liabilities_1'] = $request->total_liabilities_1;
            $data['current_liabilities_1'] = $request->current_liabilities_1;
            $data['profit_before_taxes_1'] = $request->profit_before_taxes_1;
            $data['profit_after_taxes_1'] = $request->profit_after_taxes_1;
            $data['total_turnover_2'] = $request->total_turnover_2;
            $data['total_assets_2'] = $request->total_assets_2;
            $data['current_assets_2'] = $request->current_assets_2;
            $data['total_liabilities_2'] = $request->total_liabilities_2;
            $data['current_liabilities_2'] = $request->current_liabilities_2;
            $data['profit_before_taxes_2'] = $request->profit_before_taxes_2;
            $data['profit_after_taxes_2'] = $request->profit_after_taxes_2;
//        dd($data);
        $customer->update($data);

        toast('Customer updated successfully', 'success', 'top-right');

        return redirect()->route('customer.show',$customer->id);
    }

    public function destroy(Customer $customer)
    {
        //
    }

    public function getEvents(Request $request)
    {
        if ($request->has('customer_id')) {
            $prospect = Customer::find($request->customer_id);
            $activities = $prospect->activities;
            return response()->json([
                'status' => 'success',
                'data' => fractal($activities,new ActivityTransformer())
            ]);
        }

        $activities = Activity::all();
        return response()->json([
            'status' => 'success',
            'data' => fractal($activities,new ActivityTransformer())
        ]);
    }

    public function showCalendar(Request $request, Customer $customer)
    {
        return view('customers.activities.calendar', get_defined_vars());
    }

    public function storeActivity(Request $request, Customer $customer)
    {
//        dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'date' => 'required',
            'activity_type' => 'required'
        ]);

        $data = [
            'creator_id' => $request->user()->id,
            'type' => $request->activity_type,
            'customer_id' => $customer->id,
            'title' => $request->title,
            'cost' => $request->cost,
            'assignee_id' => $request->assigned_to,
            'description' => $request->description,
            'date' => $request->date,
            'deadline' => $request->deadline
        ];

        Activity::create($data);

        toast('activity created', 'success', 'top-right');

        return redirect()->route('customer.show', $customer->id);
    }

    public function createActivity(Customer $customer)
    {
        $system_users = User::all();
        return view('customers.activities.create', get_defined_vars());
    }

    public function createOpportunity(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'assigned_to' => 'required',
            'title' => 'required',
            'deadline' => 'required',
            'probability' => 'required',
            'opportunity_value' => 'required',
            'type' => 'required',
        ]);

        $customer->opportunities()->create([
            'title' => $request->title,
            'creator_id' => $request->user()->id,
            'probability' => $request->probability,
            'opportunity_value' => $request->opportunity_value,
            'target_value' => ($request->opportunity_value * ($request->probability / 100)),
            'deadline' => $request->deadline,
            'assignee_id' => $request->assigned_to,
            'competitors' => $request->competitors,
            'type' => $request->type,
            'type_description' => $request->type_description
        ]);

        $opportunities = $customer->opportunities;

        $estimate_value = 0;

        foreach ($opportunities as $opportunity) {
            $estimate_value += $opportunity->opportunity_value;
        }

        $customer->estimate_amount = $estimate_value;
        $customer->save();

        //sendmail
        $title = config('messages.email_opportunity_title');
        $body = config('messages.email_opportunity_body');
        $name = $customer->name;
        Mail::to([$customer->email,$customer->assignee->email,$customer->creator->email])->send((new EmailOnActionComplete($title,$body,$name)));

        toast("Opportunity added successfully", 'success', 'top-right');

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function addToCompany(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'company' => 'required'
        ]);

        $customer->company_id = $request->company;
        $customer->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
