<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class Review extends SaleModelAbs
{
    public $guarded = [];

    protected $with = ['user'];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
