<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    protected $fillable = array('mouse_id', 'systolic', 'diastolic', 'taken_on');

    public function mice(){
        return $this->belongsTo(Mouse::class);
    }
}
