<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectiveReview extends Model
{
    protected $fillable=['objective_id', 'user_id', 'review'];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
