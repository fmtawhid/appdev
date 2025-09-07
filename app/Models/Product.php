<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'description'];

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to many languages
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_product');
    }

    // Product has many images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Product has many key features
    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }
}
