<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function assignedLeads()
    {
        return $this->hasMany(Lead::class, 'assignee_id', 'id');
    }

    public function leadsOwned()
    {
        return $this->hasMany(Lead::class, 'owner_id', 'id');
    }

    public function targets()
    {
        return $this->hasMany(TeamTarget::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function firebaseID($user_id)
    {
        return $this->find($user_id)->firebase_token;
    }
}
