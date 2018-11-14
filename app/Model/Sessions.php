<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $table      = "sessions";
    public $timestamps = false;


    public function user()
    {
        return $this->hasOne('App\Model\Users', 'user_id', 'users_id');
    }

}
