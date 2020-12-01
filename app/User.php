<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    
    protected $fillable = ['name', 'email', 'password', 'role_id', 'created_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];




    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');        
    }

    public function ExamType()
    {
        return $this->hasMany('App\ExamType', 'user_id');
    }

}
