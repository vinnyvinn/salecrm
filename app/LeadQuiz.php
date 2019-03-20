<?php

namespace App;

use Sale\Abs\SaleModelAbs;

class LeadQuiz extends SaleModelAbs
{
    protected $fillable = ['title','questions','trashed'];
}
