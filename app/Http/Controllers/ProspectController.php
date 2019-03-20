<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Company;
use App\Lead;
use App\Mail\EmailOnActionComplete;
use App\Prospect;
use App\Transformers\ActivityTransformer;
use App\User;
use Illuminate\Http\Request;
use Mail;

class ProspectController extends Controller
{
    public function index(Request $request)
    {
        $model = new Prospect;
        $query = $model->newQuery();

        $prospects = $query->with('company', 'opportunities')->where('stage','!=',config('sales-constants.post-prospect'))->get();
        return view('prospects.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lead $lead)
    {
        $companies = Company::all();
        $system_users = User::all();
        return view('prospects.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lead $lead)
    {
        $this->validate($request, [
            'deadline' => 'required',
            'assigned_to' =>  'required',
            'comments' =>  'required',
        ]);
        if (Prospect::where('lead_id',$lead->id)->first()){
            toast('Lead already added to prospects', 'error', 'top-right');
            return back();
        }
        $data = [
            'creator_id' => $request->user()->id,
            'lead_id' => $lead->id,
            'assignee_id' => $request->assigned_to,
            'deadline' => $request->deadline,
            'estimate_amount' => 0,
            'comments' => $request->comments,
            'company_id' => $request->company != null ? $request->company :null
        ];
// dd($data);
        $prospect = Prospect::create($data);
        $lead->stage = config('sales-constants.post-lead');
        $lead->save();

        //sendmail
        $title = config('messages.email_prospect_title');
        $body = config('messages.email_prospect_body');
        $name = $lead->name;
        Mail::to([$lead->email,$prospect->assignee->email,$prospect->creator->email])->send((new EmailOnActionComplete($title,$body,$name)));
        toast('Lead added to prospects', 'success', 'top-right');

        return redirect()->route('prospects.index');
    }


    public function getCalendar(Prospect $prospect)
    {
        return view('prospects.activities.calendar', get_defined_vars());
    }

    public function addToCompany(Request $request,Prospect $prospect)
    {
        $this->validate($request, [
            'company' => 'required'
        ]);

        $prospect->company_id = $request->company;
        $prospect->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function createActivity(Prospect $prospect)
    {
        $system_users = User::all();
        return view('prospects.activities.create', get_defined_vars());
    }

    public function storeActivity(Request $request, $prospect_id)
    {
        $prospect = Prospect::find($prospect_id);
//        dd($prospect);
        $this->validate($request, [
            'title' => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
            'deadline' => 'required',
//            'cost' => 'required',
            'date' => 'required',
            'activity_type' => 'required'
        ]);

        $data = [
            'creator_id' => $request->user()->id,
            'type' => $request->activity_type,
            'prospect_id' => $prospect->id,
            'title' => $request->title,
            'cost' => $request->cost,
            'assignee_id' => $request->assigned_to,
            'description' => $request->description,
            'date' => $request->date,
            'deadline' => $request->deadline
        ];

        Activity::create($data);

        toast('activity created', 'success', 'top-right');

        return redirect()->route('prospects.show', $prospect->id);

    }

    public function show(Prospect $prospect)
    {
        $users = User::all();
        $activities = $prospect->activities()->take(5)->get();
        return view('prospects.show', get_defined_vars());
    }

    public function edit(Prospect $prospect)
    {
        // dd($prospect->lead);
        $lead = $prospect->lead;
        $companies = Company::all();
        $system_users = User::all();
        return view('prospects.edit', get_defined_vars());
    }

    public function update(Request $request, Prospect $prospect)
    {
        $this->validate($request, [
            'deadline' => 'required',
            'estimated_value' =>  'required',
            'assigned_to' =>  'required',
            'comments' =>  'required',
        ]);

            $prospect->creator_id = $request->user()->id;
            $prospect->assignee_id  = $request->assigned_to;
            $prospect->deadline = $request->deadline;
            $prospect->estimate_amount = $request->estimated_value;
            $prospect->comments = $request->comments;
            $prospect->company_id = $request->company != null ? $request->company :null;
            $prospect->save();

        //sendmail
        toast('prospect details updated', 'success', 'top-right');

        return redirect()->route('prospects.edit', $prospect->id);
    }

    public function destroy(Prospect $prospect)
    {
        //
    }

    public function getEvents(Request $request)
    {
        if ($request->has('prospect_id')) {
            $prospect = Prospect::find($request->prospect_id);
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

    public function toggleCompletion(Activity $activity)
    {
        $activity->completed = true;
        $activity->save();
        toast('task marked as complete', 'success', 'top-right');
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function toggleCancellation(Activity $activity)
    {
        $activity->cancelled = true;
        $activity->save();
        toast('activity cancelled', 'success', 'top-right');
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updateStatus(Request $request,Prospect $prospect)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);
        $prospect->status = $request->status;
        $prospect->save();

        if ($prospect->status == 'won') {
            return redirect()->route('customer.create', $prospect->id);
        }

        toast("status updated to $prospect->status");

        return back();
    }

    public function createOpportunity(Request $request, Prospect $prospect)
    {
        $this->validate($request, [
            'assigned_to' => 'required',
            'title' => 'required',
            'deadline' => 'required',
            'probability' => 'required',
            'opportunity_value' => 'required',
            'type' => 'required',
        ]);

        $prospect->opportunities()->create([
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

        $opportunities = $prospect->opportunities;

        $estimate_value = 0;

        foreach ($opportunities as $opportunity) {
            $estimate_value += $opportunity->opportunity_value;
        }

        $prospect->estimate_amount = $estimate_value;
        $prospect->save();
        //sendmail
        $title = config('messages.email_opportunity_title');
        $body = config('messages.email_opportunity_body');
        $name = $prospect->lead->name;
        Mail::to([$prospect->lead->email,$prospect->assignee->email,$prospect->creator->email])->send((new EmailOnActionComplete($title,$body,$name)));

        toast("Opportunity added successfully", 'success', 'top-right');

        return response()->json([
            'status' => 'success'
        ]);
    }
}
