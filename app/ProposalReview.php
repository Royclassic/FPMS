<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalReview extends Model
{
    protected $fillable=['proposal_id', 'user_id', 'review'];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }
}
