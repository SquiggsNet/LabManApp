<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = array('mouse_id', 'weight', 'weighed_on');

    public function mice(){
        return $this->belongsTo(Mouse::class);
    }
}
