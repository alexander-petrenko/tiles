<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
use Illuminate\Support\Str;

class BrandController extends Controller
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
        
        $brands = Brand::all();
        
        return view('admin.brands.brands', [
            'brands' => $brands,
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

        return view('admin.brands.brandCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCreateRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Brand::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $url = $this->imageSaver->upload($request, null, 'brands');

        $brand = Brand::create([
            'name' => $data['name'],
            'slug' => $slug,
            'country' => $data['country'],
            'url' => $url
        ]);

        $message = $brand ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('brands.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $collections = $brand->collections()->get();

        return view('admin.collections.collections', [
            'collections' => $collections
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $brand = Brand::where('slug', $slug)->first();

        return view('admin.brands.brandEdit', [
            'brand' => $brand,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Brand::class, $slug, $brand->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        if (!isset($data['image'])) {
            $brand->update([
                'name' => $data['name'],
                'slug' => $slug,
                'country' => $data['country']
            ]);
        } else {
            $url = $this->imageSaver->upload($request, $brand, 'brands');

            $brand->update([
                'name' => $data['name'],
                'slug' => $slug,
                'country' => $data['country'],
                'url' => $url
            ]);
        }

        $message = $brand ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('brands.edit', $brand->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->imageSaver->remove($brand, 'brands');

        $message = $brand->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('brands.index')->with('message', $message);
    }
}
