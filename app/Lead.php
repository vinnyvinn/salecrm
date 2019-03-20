<?php

namespace App;

use App\Prospect;
use App\User;
use Sale\Abs\SaleModelAbs;

class Lead extends SaleModelAbs
{
    protected $guarded = [];


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function company()
    {
    	return $this->belongsTo(Company::class);
    }

    public function prospect()
    {
    	return $this->hasOne(Prospect::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    
    public function leadQuizResults()
    {
        return $this->hasOne(LeadQuizResult::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'lead_id', 'id');
    }
}
