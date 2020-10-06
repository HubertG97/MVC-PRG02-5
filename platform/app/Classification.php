<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    public function cryptos(){
        return $this->hasMany(Crypto::class);
    }

    public function Classification(){
        return $this->belongsTo(User::class);

    }
}
