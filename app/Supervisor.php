<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = [
        'user_id'
    ];
    public $timestamps=true;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
}
