<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
