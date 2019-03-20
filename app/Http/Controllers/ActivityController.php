<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Http\Requests\ActivityRequest;
use App\Transformers\ActivityTransformer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Sale\Repo\ActivityRepo;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new Activity();
        $query = $model->newQuery();
        $relationships = ['prospect','assignee','creator','lead','customer','opportunity'];
        if ($request->has('assignee')) {
            if ($request->assignee != 'all') {
                $query->where('assignee_id', $request->assignee);
            }
        }
        $activities = $query->with($relationships)->get();
        $assignees = User::all();
        return view('activity.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        ActivityRepo::init()->createActivity($request);
        ActivityRepo::init()->sendMail($request);

        alert()->success('Success', 'Activity added successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return fractal($activity, new ActivityTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $activity->note = $request->note;
        $activity->completed = 1;
        $activity->save();

        alert()->success('Success','Updated Successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
