<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compartment extends Model
{
    public function storage(){
        return $this->belongsTo(Storage::class);
    }

    //one-to-many relationships
    //Tissue
    public function shelves(){
        return $this->hasMany(Shelf::class);
    }
}
