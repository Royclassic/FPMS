<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{
    protected $table = 'client_details';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
