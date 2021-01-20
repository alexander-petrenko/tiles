<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surface extends Model
{
    protected $table = 'surfaces';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
