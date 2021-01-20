<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'country', 'url'];

    protected $searchable = [
        'name'
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
