<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Material;
use App\Models\Shape;
use App\Models\Style;
use App\Models\Surface;
use Illuminate\Support\Str;

class ProductController extends Controller
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

        $products = Product::all();
        
        return view('admin.products.products', [
            'products' => $products,
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

        $categories = Category::all();
        $collections = Collection::all();
        $shapes = Shape::all();
        $materials = Material::all();
        $surfaces = Surface::all();
        $styles = Style::all();

        return view('admin.products.productCreate', [
            'categories' => $categories,
            'collections' => $collections,
            'shapes' => $shapes,
            'materials' => $materials,
            'surfaces' => $surfaces,
            'styles' => $styles,
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();

        $collection_name = Collection::findOrFail($data['collection'])->name;

        $name = $collection_name . '_' . $data['color'];

        $slug = Str::slug($name);

        $slugCheck = slugCreateCheck(Product::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $url = $this->imageSaver->upload($request, null, 'products');

        $product = Product::create([
            'code' => $data['code'],
            'slug' => $slug,
            'price' => $data['price'],
            'collection_id' => $data['collection'],
            'color' => $data['color'],
            'shape_id' => $data['shape'],
            'material_id' => $data['material'],
            'surface_id' => $data['surface'],
            'style_id' => $data['style'],
            'length' => $data['length'],
            'width' => $data['width'],
            'weight' => $data['weight'],
            'in_box' => $data['in_box'],
            'views' => $data['views'] ?? 0,
            'url' => $url
        ]);

        if ($product) {
            
            if (is_array($data['category'])) {
                foreach ($data['category'] as $category) {
                    $product->categories()->attach($category);
                }
            }

            $message = 'Success' . $message;
            
        } else {
            $message = 'Failed' . $message;
        }

        return redirect()->route('products.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        
        return view('admin.products.singleProduct', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $product = Product::where('slug', $slug)->first();

        $categories = Category::all();
        $collections = Collection::all();
        $shapes = Shape::all();
        $materials = Material::all();
        $surfaces = Surface::all();
        $styles = Style::all();

        return view('admin.products.productEdit', [
            'product' => $product,
            'categories' => $categories,
            'collections' => $collections,
            'shapes' => $shapes,
            'materials' => $materials,
            'surfaces' => $surfaces,
            'styles' => $styles,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $collection_name = Collection::findOrFail($data['collection'])->name;

        $name = $collection_name . '_' . $data['color'];

        $slug = Str::slug($name);

        $slugCheck = slugUpdateCheck(Product::class, $slug, $product->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        if (!isset($data['image'])) {
            $product->update([
                'code' => $data['code'],
                'slug' => $slug,
                'price' => $data['price'],
                'collection_id' => $data['collection'],
                'color' => $data['color'],
                'shape_id' => $data['shape'],
                'material_id' => $data['material'],
                'surface_id' => $data['surface'],
                'style_id' => $data['style'],
                'length' => $data['length'],
                'width' => $data['width'],
                'weight' => $data['weight'],
                'in_box' => $data['in_box'],
                'views' => $data['views'] ?? 0
            ]);
        } else {
            $url = $this->imageSaver->upload($request, $product, 'products');

            $product->update([
                'code' => $data['code'],
                'slug' => $slug,
                'price' => $data['price'],
                'collection_id' => $data['collection'],
                'color' => $data['color'],
                'shape_id' => $data['shape'],
                'material_id' => $data['material'],
                'surface_id' => $data['surface'],
                'style_id' => $data['style'],
                'length' => $data['length'],
                'width' => $data['width'],
                'weight' => $data['weight'],
                'in_box' => $data['in_box'],
                'views' => $data['views'] ?? 0,
                'url' => $url
            ]);
        }

        if ($product) {
            
            if (is_array($data['category'])) {
                $product->categories()->detach();
                foreach ($data['category'] as $category) {
                    $product->categories()->attach($category);
                }
            }

            $message = 'Success' . $message;
            
        } else {
            $message = 'Failed' . $message;
        }

        return redirect()->route('products.edit', $product->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->imageSaver->remove($product, 'products');

        $product->categories()->detach();

        $message = $product->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('products.index')->with('message', $message);
    }
}
