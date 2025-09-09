<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable=['student_id','field', 'subareas', 'main_subarea','completed', 'remarks', 'file', 'status', 'deadline'];
    public $timestamps=true;

    public function title(){
        return $this->hasOne(Title::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function problem(){
        return $this->hasOne(Problem::class);
    }
    public function objective(){
        return $this->hasOne(Objective::class);
    }
    public function reviews(){
        return $this->hasMany(ProposalReview::class);
    }
    public function files(){
        return $this->hasMany(Code::class);
    }

}
