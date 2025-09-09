<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable=['user_id', 'supervision_area'];
    public $timestamps=true;
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
