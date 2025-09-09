<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=['faculty_id', 'course'];
    public $timestamps=['course'];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function timetable(){
        return $this->hasOne(Timetable::class);
    }
}
