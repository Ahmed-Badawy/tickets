<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['title','description','image','audio','latitude','longitude','branch'];


}
