<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

use URL;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'admins';

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token','created_at','updated_at'];

    public function setPasswordAttribute($input)
    {
        if($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    public function getImageAttribute($image)
    {
        return $image ? URL::to('').'/images/admins/'.$image : null;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')->withDefault();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
