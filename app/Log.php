<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable=['student_id','milestone', 'comments', 'approved', 'signed', 'additional_tasks', 'completion'];
    public $timestamps=true;
    public function student(){
        return $this->belongsTo(Student::class);
    }

}
