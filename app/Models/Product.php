<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function category() {
        return $this->belongsTo(Category::class,'cat_id', 'id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class);
       //return $this->hasMany(SubCategory, 'category_id');
    }
    public function images()
    {
     return $this->hasMany('App\Image', 'product_id');
    }
   
}
