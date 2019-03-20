<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function leads()
    {
    	return $this->hasMany(Lead::class);
    }

    public function prospects()
    {
    	return $this->hasMany(Prospect::class);
    }
    public function customers()
    {
    	return $this->hasMany(Customer::class);
    }
    public function contactPerson()
    {
        return $this->hasMany(ContactPerson::class);
    }
}
