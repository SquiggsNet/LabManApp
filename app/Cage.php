<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{

    protected $fillable = array('male', 'female_one', 'female_two', 'female_three', 'room_num');

    public function mice(){
        return $this->hasMany(Mouse::class);
    }

    public function male(){
        return $this->hasOne(Mouse::class, 'id', 'male');
    }

    public function female_one(){
        return $this->hasOne(Mouse::class, 'id', 'female_one');
    }

    public function female_two(){
        return $this->hasOne(Mouse::class, 'id', 'female_two');
    }

    public function female_three(){
        return $this->hasOne(Mouse::class, 'id', 'female_three');
    }
}
