<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    protected $table = 'shapes';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
