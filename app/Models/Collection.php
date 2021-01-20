<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //use FullTextSearch;

    protected $table = 'collections';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'brand_id', 'texture_id', 'url'];

    protected $searchable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function texture()
    {
        return $this->hasOne(Texture::class, 'id', 'texture_id');
    }
}
