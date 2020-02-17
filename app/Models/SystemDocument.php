<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemDocument extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];

    protected $appends = ['path'];
    protected $fillable = ['name', 'ext', 'size', 'saved_as'];

    public function getPathAttribute(){
        return \URL::to('').'/documents/'.$this->attributes['saved_as'];
    }
    public function getSizeAttribute(){
        return human_filesize($this->attributes['size']);
    }
}
