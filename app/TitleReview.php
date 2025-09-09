<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitleReview extends Model
{
    protected $fillable=['title_id', 'user_id', 'review'];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
