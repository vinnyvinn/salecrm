<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $guarded = [];

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function setCompetitorsAttribute($value)
    {
        return $this->attributes['competitors'] = json_encode($value);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'opportunity_id', 'id');
    }

    public function setDeadlineAttribute($value)
    {
        return $this->attributes['deadline'] = Carbon::parse($value);
    }

    public function getCompetitorsAttribute($value)
    {
        $array = [];

        if ($value == null || $value == "null") {
            return [];
        }
        $cp = json_decode($value);
        foreach ($cp as $item) {
            array_push($array, $item);
        }

        return $array;
    }
}
