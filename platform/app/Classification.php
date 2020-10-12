<?php

namespace App;

use App\Filters\ClassificationFilter;
use App\Filters\CryptoFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    public function cryptos(){
        return $this->hasMany(Crypto::class);
    }

    public function Classification(){
        return $this->belongsTo(User::class);

    }
    public function scopeFilter(Builder $builder, $request)
    {
        return (new CryptoFilter($request))->filter($builder);
    }
}
