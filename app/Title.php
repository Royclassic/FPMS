<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable=['proposal_id', 'title', 'status'];
    public $timestamps=true;
    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }
    public function reviews(){
        return $this->hasMany(TitleReview::class);
    }
}
