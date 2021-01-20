<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Requests\CollectionCreateRequest;
use App\Http\Requests\CollectionUpdateRequest;
use App\Models\Brand;
use App\Models\Texture;
use Illuminate\Support\Str;

class CollectionController extends Controller
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
        
        $collections = Collection::all();
        
        return view('admin.collections.collections', [
            'collections' => $collections,
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

        $brands = Brand::all();
        $textures = Texture::all();

        return view('admin.collections.collectionCreate', [
            'brands' => $brands,
            'textures' => $textures,
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionCreateRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Collection::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $url = $this->imageSaver->upload($request, null, 'collections');

        $collection = Collection::create([
            'name' => $data['name'],
            'slug' => $slug,
            'brand_id' => $data['brand'],
            'texture_id' => $data['texture'],
            'url' => $url
        ]);

        $message = $collection ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('collections.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $collection = Collection::where('slug', $slug)->first();
        $products = $collection->products()->get();
        
        return view('admin.products.products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $collection = Collection::where('slug', $slug)->first();
        $brands = Brand::all();
        $textures = Texture::all();

        return view('admin.collections.collectionEdit', [
            'collection' => $collection,
            'brands' => $brands,
            'textures' => $textures,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(CollectionUpdateRequest $request, Collection $collection)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Collection::class, $slug, $collection->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        if (!isset($data['image'])) {
            $collection->update([
                'name' => $data['name'],
                'slug' => $slug,
                'brand_id' => $data['brand'],
                'texture_id' => $data['texture']
            ]);
        } else {
            $url = $this->imageSaver->upload($request, $collection, 'collections');

            $collection->update([
                'name' => $data['name'],
                'slug' => $slug,
                'brand_id' => $data['brand'],
                'texture_id' => $data['texture'],
                'url' => $url
            ]);
        }

        $message = $collection ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('collections.edit', $collection->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $this->imageSaver->remove($collection, 'collections');

        $message = $collection->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('collections.index')->with('message', $message);
    }
}
