<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        //return $this->belongsToMany(Category::class);
       // return $this->hasMany(Category, 'category_id');
       return $this->hasMany(SubCategory, 'category_id');
    }

   
}
