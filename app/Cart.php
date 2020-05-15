<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
