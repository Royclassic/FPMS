<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemReview extends Model
{
    protected $fillable=['problem_id', 'user_id', 'review'];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
