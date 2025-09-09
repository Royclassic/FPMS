<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = ['proposal_id', 'problem', 'status'];
    public $timestamps = true;

    public function reviews()
    {
        return $this->hasMany(ProblemReview::class);
    }

    public function getProblemContentAttribute()
    {
        //show only 100 characters of the problem, omitting CSS and HTML tags
        $problemWithoutTags = strip_tags($this->problem);
        return substr($problemWithoutTags, 0, 100);

    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
