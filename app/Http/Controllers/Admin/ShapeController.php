<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShapeRequest;
use App\Models\Shape;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = session()->get('message') ?? NULL;
        
        $shapes = Shape::all();
        
        return view('admin.shapes.shapes', [
            'shapes' => $shapes,
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

        return view('admin.shapes.shapeCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShapeRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Shape::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $shape = Shape::create([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $shape ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('shapes.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Http\Response
     */
    public function show(Shape $shape)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $shape = Shape::where('slug', $slug)->first();

        return view('admin.shapes.shapeEdit', [
            'shape' => $shape,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Http\Response
     */
    public function update(ShapeRequest $request, Shape $shape)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Shape::class, $slug, $shape->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $shape->update([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $shape ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('shapes.edit', $shape->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shape $shape)
    {
        $message = $shape->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('shapes.index')->with('message', $message);
    }
}
