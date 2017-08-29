<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    public function compartment(){
        return $this->belongsTo(Compartment::class);
    }

    //one-to-many relationships
    //Tissue
    public function boxes(){
        return $this->hasMany(Box::class);
    }
}
