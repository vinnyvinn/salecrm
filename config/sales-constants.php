<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 7/27/18
 * Time: 1:25 PM
 */
return [
    'prospect-statuses' => [
        'New Opportunity', 'Pre-Approach', 'Initial Communication', 'First Interview', 'Opportunity Analysis',
        'Solution Development','Solution Presentation','Customer Evaluation','Negotiation','Commitment to Purchase','Follow Up','Closed Dea',
        'lost', 'won', 'future'

    ],
//    /.lead stage
    'default' => 0,
    'questionnaire' => 1,
    'reviews' => 2,
    'prospect' => 3,
    'post-lead' => 4,

    //lead status
    'open' => 'open',
    'qualified' => 'qualified',
    'unqualified' => 'unqualified',

    //lead stages
    'activities-stage' => 1,
    'post-prospect' =>2,

    //target status
    'progress' => 0,
    'not-archived' => 1,
    'archived' => 2,


    //prospects stages
    'won' => 'won',
    'lost' => 'lost',

    //review types
    'legal' => 'legal',
    'financial' => 'financial',
    'general' => 'general',
    //activites types
    'activity-types' => [
        'call'     => 'call',
        'email'    => 'email',
        'todo'     => 'todo',
        'meetings' => 'meetings'
    ],
    'opportunity-types' => [
        'road-freight' => 'Road Freight',
        'air-freight' => 'Air freight',
        'warehousing' => 'Warehousing',
        'custom-clearance' => 'Customs Clearance',
        'sea-freight' => 'Sea freight',
        'ships-agency' => 'Ships Agency'

    ]
];