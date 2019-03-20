<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamTarget;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('team.index')
            ->withTeams(Team::with(['user'])->has('user')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Team::create([
            'user_id' => $newUser->id,
            'job_title' => $data['job_title'],
            'employee_id' => $data['employee_id'],
            'phone_no' => $data['phone_no'],
        ]);

        alert()->success('Success','Team Member Added Successfully');

        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $data = $request->all();

        $user = User::find($team->user_id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $team->update([
            'job_title' => $data['job_title'],
            'employee_id' => $data['employee_id'],
            'phone_no' => $data['phone_no']
        ]);

        alert()->success('Updated','Team Updated Successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
//['user_id','start_date','end_date','total_leads','revenue','status','trashed']

    public function indexTarget()
    {
        return view('team.target')
            ->withTeams(Team::with(['user'])->get())
            ->withTargets(TeamTarget::with(['user.targets','user.leadsOwned.prospect'])->get());
    }

    public function createTarget()
    {
        return view('team.create-target')
            ->withTeams(Team::with(['user'])->get());
    }

    public function storeTarget(Request $request)
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        if ($start->gt($end)){
            alert()->error('Error','Start Date Cannot Bw Greater Than End Date');

            return redirect()->back();
        }

        TeamTarget::create([
            'user_id' => $request->user_id,
            'start_date' => $start,
            'end_date' => $end,
            'title' => $request->title,
            'total_leads' => $request->total_leads,
            'revenue' => $request->revenue,
            'status' => config('sales-constants.progress'),
        ]);

        alert()->success('Success', 'Target Added Successfully');

        return redirect('target');
    }

    public static function getRevenue($leads)
    {
        dd($leads);
    }

    public function getTeamTarget($user_id)
    {
        return view('team.target')
            ->withTeams(Team::with(['user'])->get())
            ->withTargets(TeamTarget::with(['user.targets','user.leadsOwned.prospect'])->where('user_id', $user_id)->get());
    }
}
