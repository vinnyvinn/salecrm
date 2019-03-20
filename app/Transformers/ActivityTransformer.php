<?php

namespace App\Transformers;

use App\Activity;
use League\Fractal\TransformerAbstract;

class ActivityTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Activity $activity)
    {
        return [
            'id' => $activity->id,
            'title' => $activity->title,
            'type' => $activity->type,
            'description' => $activity->description,
            'start'=> $activity->deadline->format('Y-m-d'),
            'constraint'=> 'availableForMeeting',
            'editable'=> false,
            'borderColor'=> '#4fc3f7',
            'backgroundColor'=> '#4fc3f7',
            'textColor'=> '#fff'
        ];
    }
}
