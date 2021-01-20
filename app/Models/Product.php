<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use FullTextSearch;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = ['code', 'slug', 'price', 'collection_id', 'color', 'shape_id', 'material_id', 'surface_id', 'style_id', 'length', 'width', 'weight', 'in_box', 'views', 'url'];

    protected $searchable = [
        'code'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function collection()
    {
        return $this->hasOne(Collection::class, 'id', 'collection_id');
    }

    public function shape()
    {
        return $this->hasOne(Shape::class, 'id', 'shape_id');
    }

    public function material()
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function surface()
    {
        return $this->hasOne(Surface::class, 'id', 'surface_id');
    }

    public function style()
    {
        return $this->hasOne(Style::class, 'id', 'style_id');
    }
}
