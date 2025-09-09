<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{


    protected $fillable = ['faculty'];
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
