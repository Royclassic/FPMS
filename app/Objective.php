<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable=['proposal_id','questions', 'objectives', 'status'];
    public $timestamps=true;

    // public function getQuestionsContentAttribute(){
    //     return substr($this->questions,0,120).'...';
    // }
    // public function getObjectivesContentAttribute(){
    //     return substr($this->objectives,0,120).'...';
    // }
    public function getQuestionsContentAttribute(){
        $noHTML = strip_tags($this->questions);
        return substr($noHTML, 0, 60).'...';
    }
    
    public function getObjectivesContentAttribute(){
        $noHTML = strip_tags($this->objectives);
        return substr($noHTML, 0, 60).'...';
    }
    public function reviews(){
        return $this->hasMany(ObjectiveReview::class);
    }
    public function proposal(){
        return $this->belongsTo(Proposal::class);
    }
}
