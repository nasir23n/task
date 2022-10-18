<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'price',
        'vat',
        'discount',
        'image',
        'description',
    ];
    public function product_images() {
        return $this->hasMany(ProductImage::class);
    }
}
