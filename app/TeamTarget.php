<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class TeamTarget extends SaleModelAbs
{
    protected $fillable = ['user_id','start_date','title','end_date','total_leads','revenue','status','trashed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
