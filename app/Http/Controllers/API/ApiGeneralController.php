<?php

namespace App\Http\Controllers\API;

use App\Activity;
use App\Customer;
use App\Lead;
use App\Opportunity;
use App\Prospect;
use App\TeamTarget;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Sale\Repo\ActivityRepo;
use Sale\Repo\ApiRepo;

class ApiGeneralController extends Controller
{
    public function createLead(Request $request)
    {
        if (!ApiRepo::validateApiRequest($request,[
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'country' => 'required',
        ])){
            return ApiRepo::responseError('Invalid inputs');
        }

        else{
            $lead = new Lead();

            $addedLead = ApiRepo::store($lead, [
                'creator_id' => $request->user()->id,
                'owner_id' => $request->user()->id,
                'title' => $request->has('job_title') ? $request->title : '',
                'name' => $request->name,
                'job_title' => $request->has('job_title') ? $request->job_title : '',
                'email' => $request->email,
                'phone' => $request->phone,
                'assignee_id' => $request->user()->id,
                'description' => $request->description,
                'address_1' => $request->address_1,
                'address_2' => $request->has('address_2') ? $request->address_2 : '',
                'city' => $request->city,
                'country' => $request->country,
            ]);

            return ApiRepo::responseSuccess([
                'msg' => ucwords($addedLead->name).' added successfully'
            ],'addLead');
        }
    }

    public function createActivity(Request $request)
    {
        if (!ApiRepo::validateApiRequest($request,[
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'cost' => 'required',
//            'date' => 'sometimes',
            'deadline' => 'required',
            'assignee_id' => 'required',
        ])){
            return ApiRepo::responseError('Invalid inputs');
        }

        else{
//            dd(Auth::user());
            $activity = ActivityRepo::init()->createActivity($request,$request->user()->id);

            return ApiRepo::responseSuccess([
                'msg' => ucwords($activity->title).' added successfully'
            ],'addActivity');
        }
    }

    public function indexProspect()
    {
        $prospects = Prospect::with(['activities','lead','company'])->where('status',config('sales-constants.open'))->where('assignee_id',Auth::user()->id)->get();

        $results = $prospects->map(function ($value,$key){

            return [
                'prospect_id' => $value->id,
                'name' => $value->lead->name,
                'title' => $value->lead->title,
                'job_title' => $value->lead->job_title,
                'email' => $value->lead->email,
                'phone' => $value->lead->phone,
                'description' => $value->lead->description,
                'address' => $value->lead->address_1.', '.$value->lead->address_2,
                'country' => $value->lead->country,
                'city' => $value->lead->city,
                'estimate_amount' => $value->estimate_amount,
                'prospect_deadline' => $value->deadline->format('Y-m-d H:m:s'),
                'comments' => $value->comments,
                'status' => $value->status,
                'stage' => $value->stage,
                'company_id' => $value->company == null ? '' : $value->company->id,
                'company_name' => $value->company == null ? '' : $value->company->name,
//                'activities' => ActivityRepo::init()->getActivities($value->activities),
//                'company' => $value->company == null ? '' : $value->company
            ];
        })->reject(null)->toArray();

        return ApiRepo::responseSuccess($results,'prospects');
    }

    public function indexLead()
    {

        $leads = Lead::with(['company','activities'])->where('status',config('sales-constants.open'))->where('assignee_id', Auth::user()->id)->get();

        $data = [];

        foreach ($leads as $lead){

            array_push($data,[
                'id' => $lead->id,
                'creator_id' => $lead->creator_id,
                'owner_id' => $lead->owner_id,
                'assignee_id' => $lead->assignee_id,
                'name' => $lead->name,
                'title' => $lead->title,
                'job_title' => $lead->job_title,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'description' => $lead->description,
                'address_1' => $lead->address_1,
                'address_2' => $lead->address_2,
                'country' => $lead->country,
                'city' => $lead->city,
                'status' => $lead->status,
                'stage' => $lead->stage,
                'trashed' => $lead->trashed,
                'created_at' => Carbon::parse($lead->created_at)->format('Y-m-d'),
                'updated_at' => $lead->updated_at->format('Y-m-d'),
                'company_name' => $lead->company == null ? '' : $lead->company->name,
                'company_id' => $lead->company == null ? '' : $lead->company->id,
//                'company' => $lead->company == null ? '' : $lead->company,
//                'activities' => $lead->activities == null ? '' : ActivityRepo::init()->getActivities($lead->activities)
            ]);
        }

        return ApiRepo::responseSuccess(['myLeads' =>$data], 'leads');
    }

    public function indexOpportunity()
    {
        $opportunities = Opportunity::with(['prospect.lead','customer','activities'])->get();

        $data = [];

        foreach ($opportunities as $opportunity){

            $competitors = 'Competitors: ';

            if ($opportunity->competitors != null){
//                dd( );
                foreach ($opportunity->competitors as $item){
//                    dd();
                    $competitors = $competitors.$item->text.', ';
                }
            }
            else{
                $competitors = '';
            }

            array_push($data,[
                'id'  => $opportunity->id,
                'customer_id'  => $opportunity->customer_id,
                'customer_name'  => $opportunity->customer != null ? $opportunity->customer->name : '',
                'creator_id' => $opportunity->creator_id,
                'assignee_id' => $opportunity->assignee_id,
                'deadline' => Carbon::parse($opportunity->deadline)->format('Y-m-d'),
                'prospect_id' => $opportunity->prospect_id,
                'prospect_name' => $opportunity->prospect != null ? $opportunity->prospect->lead->name : '',
                'probability' => $opportunity->probability,
                'title' => $opportunity->title,
                'type' =>  $opportunity->customer != null ? 'customer' : 'prospect',
                'opportunity_value' => $opportunity->opportunity_value,
                'target_value' => $opportunity->target_value,
                'competitors' => $competitors,
                'status' => $opportunity->status,
//                'activities' => $opportunity->activities == null ? '' : ActivityRepo::init()->getActivities($opportunity->activities)
            ]);
        }

        return ApiRepo::responseSuccess($data, 'opportunities');

    }

    public function indexCustomer()
    {
        $customers = Customer::with(['company','activities'])->where('assignee_id', Auth::user()->id)->get();
        $data = [];

        foreach ($customers as $customer){
            array_push($data,[
                'id' =>  $customer->id,
                'creator_id' =>  $customer->creator_id,
                'assignee_id' => $customer->assignee_id,
                'estimate_amount' => (int) $customer->estimate_amount,
                'company_id' => $customer->company_id,
                'company_name' => $customer->company == null ? null : $customer->company->name,
                'prospect_id' => $customer->prospect_id,
                'bank_name' => $customer->bank_name,
                'bank_address' => $customer->bank_address,
                'owner_id' => $customer->owner_id,
                'name' => $customer->name,
                'title' => $customer->title,
                'job_title' => $customer->job_title,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'description' => $customer->description,
                'address_1' => $customer->address_1,
                'address_2' => $customer->address_2,
                'country' => $customer->country,
                'city' => $customer->city,
                'bank_branch' => $customer->bank_branch,
                'bank_code' => $customer->bank_code,
                'swiftcode' => $customer->swiftcode,
                'bank_account_no' => $customer->bank_account_no,
                'payment_date' => $customer->payment_date,
                'payment_mode' => $customer->payment_mode,
                'currency' => $customer->currency,
                'co_name_1' => $customer->co_name_1,
                'co_contact_name_1' => $customer->co_contact_name_1,
                'co_address_1' => $customer->co_address_1,
                'co_city_1' => $customer->co_city_1,
                'co_postcode_1' => $customer->co_postcode_1,
                'co_phone_1' => $customer->co_phone_1,
                'co_email_1' => $customer->co_email_1,
                'co_comment_1' => $customer->co_comment_1,
                'co_name_2' => $customer->co_name_2,
                'co_contact_name_2' => $customer->co_contact_name_2,
                'co_address_2' => $customer->co_address_2,
                'co_city_2' => $customer->co_city_2,
                'co_postcode_2' => $customer->co_postcode_2,
                'co_phone_2' => $customer->co_phone_2,
                'co_email_2' => $customer->co_email_2,
                'co_comment_2' => $customer->co_comment_2,
                'terms' => $customer->terms,
                'pin_cert' => $customer->pin_cert,
                'vat_cert' => $customer->vat_cert,
                'co_reg_cert' => $customer->co_reg_cert,
                'rep_id_file' => $customer->rep_id_file,
                'directors_list' => $customer->directors_list,
                'utility_bill' => $customer->utility_bill,
                'total_turnover_1' => $customer->total_turnover_1,
                'total_assets_1' => $customer->total_assets_1,
                'current_assets_1' => $customer->current_assets_1,
                'total_liabilities_1' => $customer->total_liabilities_1,
                'current_liabilities_1' => $customer->current_liabilities_1,
                'profit_before_taxes_1' => $customer->profit_before_taxes_1,
                'profit_after_taxes_1' => $customer->profit_after_taxes_1,
                'total_turnover_2' => $customer->total_turnover_2,
                'total_assets_2' => $customer->total_assets_2,
                'current_assets_2' => $customer->current_assets_2,
                'total_liabilities_2' => $customer->total_liabilities_2,
                'current_liabilities_2' => $customer->current_liabilities_2,
                'profit_before_taxes_2' => $customer->profit_before_taxes_2,
                'profit_after_taxes_2' => $customer->profit_after_taxes_2,
                'status' => $customer->status,
                'stage' => $customer->stage,
                'trashed' => $customer->trashed,
//                'company' => $customer->company == null ? null : $customer->company,
//                'activities' => $customer->activities == null ? null : ActivityRepo::init()->getActivities($customer->activities),
            ]);
        }

        return ApiRepo::responseSuccess($data, 'customers');
    }

    public function getLeads()
    {
        return response(['msg' => Lead::with(['company'])->where('status',config('sales-constants.open'))->get()->toArray()]);
    }

    public function getProspects()
    {
        return response(['msg' => Prospect::with(['company','lead'])->where('status','open')->get()->toArray()]);
    }

    public function getCustomer()
    {
        return response(['msg' => Customer::with(['company'])->get()->toArray()]);
    }

    public function getOpportunities()
    {
        $opportunities = Opportunity::with(['prospect.lead','customer','activities'])->get();


        return response(['msg' => $opportunities->toArray()]);
    }

    public function indexActivity()
    {
        $activities = Activity::all();

        $data = [];

        foreach ($activities as $activity){
            array_push($data,[
                'id' => $activity->id,
                'creator_id' => $activity->creator_id,
                'assignee_id' => $activity->assignee_id,
                'prospect_id' =>$activity->prospect_id,
                'customer_id' => $activity->customer_id,
                'opportunity_id' => $activity->opportunity_id,
                'lead_id' => $activity->lead_id,
                'title' => $activity->title,
                'description' => $activity->description,
                'type' => $activity->type,
                'lat' => $activity->lat,
                'lng' => $activity->lng,
                'cost' => $activity->cost,
                'note' => $activity->note,
                'deadline_date' => Carbon::parse($activity->deadline)->toDateString(),
                'deadline_time' => Carbon::parse($activity->deadline)->toTimeString(),
                'cancelled' => $activity->cancelled,
                'completed' => $activity->completed,
                'created_at' => $activity->created_at->toDateTimeString(),
                'updated_at' => $activity->updated_at->toDateTimeString(),
            ]);
        }

        return ApiRepo::responseSuccess($data, 'activities');
    }

    public function getProfile()
    {
        $user = Auth::user();

        if ($user == null){
            return ApiRepo::responseError('No user');
        }

        return ApiRepo::responseSuccess([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'job_title' => $user->team != null  ? ' ' : $user->team->job_title,
            'employee_id' => $user->team != null  ? ' ' : $user->team->employee_id,
            'phone_no' => $user->team != null  ? ' ' : $user->team->phone_no,
        ],'userProfile');
    }

    public function getTarget()
    {
        $user = Auth::user();

        $targets = TeamTarget::where('user_id', $user->id)->get()->toArray();
        $data = [];

        foreach ($targets as $target){
            array_push($data,[
                'id' => $target['id'],
                'user_id' => $target['user_id'],
                'start_date' => $target['start_date'],
                'title' => $target['title'],
                'progress' => 60,
                'end_date' => $target['end_date'],
                'total_leads' => $target['total_leads'],
                'revenue' => $target['revenue'],
                'status' => $target['status'],
                'trashed' => $target['trashed'],
                'created_at' => $target['created_at'],
                'updated_at' => $target['updated_at'],
            ]);
        }

        return ApiRepo::responseSuccess($data, 'targets');
    }

    public function setFirebaseToken($firebaseToken)
    {
        $user = Auth::guard('api')->user();
        $user->firebase_token = $firebaseToken;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Success'
        ]);

    }

}
