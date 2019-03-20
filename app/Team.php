<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class Team extends SaleModelAbs
{
    protected $fillable = ['user_id','job_title','employee_id','phone_no','trashed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
