<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sale\Abs\SaleModelAbs;

class LeadQuizResult extends SaleModelAbs
{
    protected $fillable = ['lead_id','lead_quiz_id','question_result','trashed'];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function leadQuiz()
    {
        return $this->belongsTo(LeadQuiz::class);
    }
}
