<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable=['student_id', 'final_documentation', 'comment', 'status', 'completion'];
    public $timestamps=true;
    public function chapterOne(){
        return $this->hasOne(Chapterone::class);
    }
    public function chapterTwo(){
        return $this->hasOne(Chaptertwo::class);
    }
    public function chapterThree(){
        return $this->hasOne(Chapterthree::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
