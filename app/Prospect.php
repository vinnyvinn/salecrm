<?php

namespace App;

use App\Lead;
use Carbon\Carbon;
use Sale\Abs\SaleModelAbs;

class Prospect extends SaleModelAbs
{
    protected $guarded = [];

    protected $with = ['lead', 'activities'];

    public function lead()
    {
    	return $this->belongsTo(Lead::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function setDeadlineAttribute($value)
    {
        return $this->attributes['deadline'] = Carbon::parse($value);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    
    public function activities()
    {
        return $this->hasMany(Activity::class, 'prospect_id', 'id');
    }

    public function getDeadlineAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

}
