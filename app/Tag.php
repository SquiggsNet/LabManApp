<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = array('tag_num', 'lost_tag');

    public function mice(){
        return $this->belongsToMany(Mouse::class);
    }
}
