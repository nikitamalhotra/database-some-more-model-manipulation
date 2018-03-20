<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address(){
		return $this->hasOne('App\Address');
    }

	public function post(){
		return $this->hasOne('App\Post');
	}

	public function posts(){
    	return $this->hasMany('App\Post');
	}

	public function roles(){
		return $this->belongsToMany('App\Role')->withPivot('created_at');
	}

	public function photos(){
		return $this->morphMany('App\Photo', 'imageable');
	}

	//Accessors : Below three functions are an Example
	public function getNameAttribute($value){
		return strtoupper($value);         //return ucfirst($value);
	}
	public function getEmailAttribute($value){
		return strtoupper($value);         //return ucfirst($value);
	}
	public function getPasswordAttribute($value){
		return 'pass-' . $value;
	}

	//Mutator : Below function is an example of Mutator
	public function setNameAttribute($value){
		$this->attributes['name'] = strtoupper($value);
	}
}
