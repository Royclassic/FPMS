<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'supervisor_id'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function documentation()
    {
        return $this->hasOne(Documentation::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
