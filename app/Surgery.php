<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $fillable = array('user_id', 'title', 'end_date', 'scheduled_date','dose', 'treatment', 'purpose', 'comments');

    //one-to-many relationships
    //User
    public function user(){
        return $this->belongsTo(User::class);
    }

    //many-to-many relationships
    //Mouse
    public function mice(){
        return $this->belongsToMany(Mouse::class);
    }
}
