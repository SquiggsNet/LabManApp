<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = array('name');

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
