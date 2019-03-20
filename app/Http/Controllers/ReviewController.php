<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Prospect;
use App\Review;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    /**
     *
     */
    public function index()
    {
        //
    }

    /**
     * @param $lead_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function create($lead_id)
    {
        $lead = Lead::find($lead_id);
        return view('reviews.create',get_defined_vars());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'review_type' => 'required',
            'comment'  => 'required',
            'confirmed' => 'required',
            'lead_id' => 'required',
        ]);

        $type = Review::where('review_type',$request->review_type)->where('lead_id',$request->lead_id)->first();
        if ($type){
            toast("All reviews already done", 'warning', 'top-right');
            return back();
        }

        $review = new Review;
        $review->review_type = $request->review_type;
        $review->comment = $request->comment;
        $review->confirmed = $request->confirmed;
        $review->lead_id = $request->lead_id;
        $review->user_id = Auth::user()->id;
        $review->save();

        $lead = Lead::find($request->lead_id);
        if ($review->review_type === config('sales-constants.general')){
            if ($request->confirmed == true){
                $lead->stage = config('sales-constants.prospect');
                $lead->status = config('sales-constants.qualified');
            }else{
                $lead->stage = config('sales-constants.reviews');
                $lead->status = config('sales-constants.unqualified');
            }
        }else{
            $lead->stage = config('sales-constants.reviews');
        }
        $lead->save();
        toast("Review added successfully", 'success', 'top-right');
//        return back();
        return redirect()->route('leads.view',$request->lead_id);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Review $review)
    {
        return view('reviews.edit',get_defined_vars());
    }

    public function update(Request $request, Review $review)
    {
        $this->validate($request, [
            'comment'  => 'required',
            'confirmed' => 'required',
        ]);

        $review->comment = $request->comment;
        $review->confirmed = $request->confirmed;
        $review->user_id = Auth::user()->id;
        $review->save();

        $lead = Lead::find($review->lead->id);
        if ($review->review_type === config('sales-constants.general')){
            if ($request->confirmed == true){
                $lead->stage = config('sales-constants.prospect');
                $lead->status = config('sales-constants.qualified');
            }else{
                $lead->stage = config('sales-constants.reviews');
                $lead->status = config('sales-constants.unqualified');
            }
        }else{
            $lead->stage = config('sales-constants.reviews');
        }
        $lead->save();
        toast("Review updated successfully", 'success', 'top-right');
//        return back();
        return redirect()->route('leads.view',$review->lead->id);
    }
}
