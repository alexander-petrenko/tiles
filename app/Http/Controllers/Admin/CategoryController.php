<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = session()->get('message') ?? NULL;
        
        $categories = Category::all();
        
        return view('admin.categories.categories', [
            'categories' => $categories,
            'message' => $message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = session()->get('message') ?? NULL;

        return view('admin.categories.categoryCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Category::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $url = $this->imageSaver->upload($request, null, 'categories');

        $category = Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'url' => $url
        ]);

        $message = $category ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('categories.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()->get();

        return view('admin.products.products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $category = Category::where('slug', $slug)->first();

        return view('admin.categories.categoryEdit', [
            'category' => $category,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Category::class, $slug, $category->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        if (!isset($data['image'])) {
            $category->update([
                'name' => $data['name'],
                'slug' => $slug
            ]);
        } else {
            $url = $this->imageSaver->upload($request, $category, 'categories');

            $category->update([
                'name' => $data['name'],
                'slug' => $slug,
                'url' => $url
            ]);
        }

        $message = $category ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('categories.edit', $category->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->imageSaver->remove($category, 'categories');

        $category->products()->detach();

        $message = $category->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('categories.index')->with('message', $message);
    }
}
