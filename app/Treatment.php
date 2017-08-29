<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = array('title', 'active');

    public function mice()
    {
        return $this->belongsToMany(Mouse::class)->withPivot('dosage');
    }
}
