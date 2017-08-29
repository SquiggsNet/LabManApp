<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = array('tissue_id', 'type', 'freezer',);

    //one-to-many relationships
    //Box
    public function compartments(){
        return $this->hasMany(Compartment::class);
    }

    public function number_of_compartments($freezer){
        return $freezer->compartments->count();
    }

    public function number_of_shelves($freezer){
        $shelves = 0;
        foreach ($freezer->compartments as $compartment) {
            $shelves += $compartment->shelves->count();
        }
        return $shelves;
    }

    public function number_of_boxes($freezer){
        $boxes = 0;
        foreach ($freezer->compartments as $compartment) {
            foreach ($compartment->shelves as $shelf)
            $boxes += $shelf->boxes->count();
        }
        return $boxes;
    }
//    //Tissue
//    public function tissues(){
//        return $this->hasMany(Tissue::class);
//    }
//
//    //many-to-many relationships
//    //Mouse
//    public function mice(){
//        return $this->belongsToMany(Mouse::class);
//    }
}
