<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('mouse_id', 'user_id', 'comment', 'timestamp');

    public function mice(){
        return $this->belongsTo(Mouse::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
