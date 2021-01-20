<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Texture;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $textures = Texture::all();
        $categories = Category::all();

        return view('admin.home', [
            'textures' => $textures,
            'categories' => $categories
        ]);
    }
}
