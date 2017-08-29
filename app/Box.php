<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = array('name');

    public function shelf(){
        return $this->belongsTo(Shelf::class);
    }

    //one-to-many relationships
    //Tissue
    public function tissues(){
        return $this->hasMany(Tissue::class);
    }

    //many-to-many relationships
    //Mouse
    public function mice(){
        return $this->belongsToMany(Mouse::class);
    }

    //one-to-many relationships
    //Tissue
    public function mouse_storages(){
        return $this->hasMany(MouseStorage::class);
    }
}
