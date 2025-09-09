<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable=['student_id', 'task_name', 'start', 'duration', 'dependency', 'percentage_complete'];
}
