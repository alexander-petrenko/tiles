<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texture extends Model
{
    protected $table = 'textures';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'url'];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
