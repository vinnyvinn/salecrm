<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class Customer extends SaleModelAbs
{
    protected $guarded = [];

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('y-m-d H:m:s');
    }

    public function setDeadlineAttribute($value)
    {
        return $this->attributes['deadline'] = Carbon::parse($value);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'customer_id', 'id');
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'customer_id', 'id');
    }
}
