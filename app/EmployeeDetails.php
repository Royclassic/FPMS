<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    protected $table = 'employee_details';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
