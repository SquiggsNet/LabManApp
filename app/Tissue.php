<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    protected $fillable = array('name', 'active');

    public function box(){
        return $this->belongsTo(Box::class);
    }
    public function mouse(){
        return $this->belongsTo(Mouse::class);
    }
}
