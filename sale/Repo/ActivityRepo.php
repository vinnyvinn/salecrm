<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 8/2/18
 * Time: 1:43 PM
 */

namespace Sale\Repo;


use App\Activity;
use App\Customer;
use App\Lead;
use App\Mail\EmailOnActionComplete;
use App\Prospect;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Mail;

class ActivityRepo
{
    public static function init()
    {
        return new self;
    }

    public function createActivity(Request $request, $user_id = null)
    {

        return Activity::create([
            'creator_id' => $user_id == null ? Auth::user()->id : $user_id,
            'assignee_id' => $request->assignee_id,
            'prospect_id' => ($request->has('related') && ($request->associate == 'prospect')) ? $request->related : null,
            'customer_id' => ($request->has('related') && ($request->associate == 'customer')) ? $request->related : null,
            'lead_id' => ($request->has('related') && ($request->associate == 'lead')) ? $request->related : null,
            'opportunity_id' => ($request->has('related') && ($request->associate == 'opportunity')) ? $request->related : null,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'cost' => $request->cost,
//            'date' => $request->date,
            'deadline' => $request->deadline,
            'co_sellers' => is_array($request->co_sellers) ? implode(',', $request->co_sellers) : null
        ]);
    }

    public function getActivities($activities)
    {
        $data = [];

        foreach ($activities as $activity) {
            array_push($data, [
                'id' => $activity->id,
                'creator_id' => $activity->creator_id,
                'assignee_id' => $activity->assignee_id,
                'prospect_id' => $activity->prospect_id,
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

        return $data;
    }

    /**
     * @param Request $request
     */
    public  function sendMail(Request $request)
    {
        //sendmail
        $email = env('MAIL_ACCOUNT');
        $title = config('messages.email_activity_title');
        $body = config('messages.email_activity_body');
        if ($request->has('related') && ($request->associate == 'prospect')){
            $prospect = Prospect::find($request->related);
            $name = $prospect->lead->name;
            $email = $prospect->lead->email;
        }else if ($request->has('related') && ($request->associate == 'customer')){
            $customer = Customer::find($request->related);
            $name = $customer->name;
            $email = $customer->email;
        }else if($request->has('related') && ($request->associate == 'lead')){
            $lead = Lead::find($request->related);
            $name = $lead->name;
            $email = $lead->email;
        }
        $assignee_mail = User::find($request->assignee_id)->email;
        Mail::to([$email,$assignee_mail,Auth::user()->email])->send((new EmailOnActionComplete($title,$body,$name)));
    }
}