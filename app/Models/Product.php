<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qty',
        'thumbnail',
        'description',
        'userId',
        'categoryId',
        'discountId',
        'viewer',
        'salePrice',
        'regularPrice'
    ];

    public function sizes(){
        return $this->belongsToMany(Size::class,'product_size','product_id','size_id');
    }
    public function colors(){
        return $this->belongsToMany(Color::class,'product_color','product_id','color_id');
    }
}
