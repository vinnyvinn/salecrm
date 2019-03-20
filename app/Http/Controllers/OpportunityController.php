<?php

namespace App\Http\Controllers;

use App\Mail\EmailOnActionComplete;
use App\Opportunity;
use App\Prospect;
use Illuminate\Http\Request;
use Mail;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $model = new Opportunity();
        $query = $model->newQuery();

        if ($request->has('stage')) {
            $query->where('status', $request->status);
        }

        $opportunities = $query->get();

        return view('opportunities.index', get_defined_vars());
    }

    public function setStatus(Request $request, Opportunity $opportunity)
    {
        $this->validate($request, [
           'status' => 'required'
        ]);
        $opportunity->status = $request->status;
        $opportunity->save();

        if($opportunity->status == 'won') {
            return response()->json([
               'status' => 'won',
                'url' => route('customer.create', $opportunity->prospect_id)
            ]);
        }

        toast("Status changed successfully", 'success', 'top-right');
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function show()
    {
        
    }
}
