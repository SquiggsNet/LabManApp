<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $fillable = array('title', 'active');
    public $timestamps = false;

    public function mice()
    {
        return $this->belongsToMany(Mouse::class);
    }
}
