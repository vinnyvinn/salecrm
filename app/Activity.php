<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class Activity extends SaleModelAbs
{

    protected $guarded = [];

    public function prospect()
    {
        return $this->belongsTo(Prospect::class, 'prospect_id', 'id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');
    }


    public function setDeadlineAttribute($value)
    {
    	return $this->attributes['deadline'] = Carbon::parse($value);
    }

    public function setDateAttribute($value)
    {
    	return $this->attributes['date'] = Carbon::parse($value);
    }

    public function getDeadlineAttribute($value)
    {
        return Carbon::parse($value);
    }


    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
