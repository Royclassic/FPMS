<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapterone extends Model
{
    protected $fillable=['documentation_id','file', 'comment', 'status', 'completion'];
    public $timestamps=true;
}
