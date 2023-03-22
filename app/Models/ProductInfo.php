<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;
    protected $table = 'product_info';
    
    
    public function product()
    {
       return $this->belongsTo('App\Product', 'product_id');
    }
}
