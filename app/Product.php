<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','description','image', 'price', 'discount', 'stock', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function money($value){
        return "R$".number_format($value,2);
    }

    public function fPrice(){
        return $this->money($this->price);
    }

    public function fDiscountPrice(){
        return $this->money($this->price * (1 - $this->discount/100));
    }

}
