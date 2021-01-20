<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurfaceRequest;
use App\Models\Surface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = session()->get('message') ?? NULL;
        
        $surfaces = Surface::all();
        
        return view('admin.surfaces.surfaces', [
            'surfaces' => $surfaces,
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

        return view('admin.surfaces.surfaceCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurfaceRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Surface::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $surface = Surface::create([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $surface ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('surfaces.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function show(Surface $surface)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $surface = Surface::where('slug', $slug)->first();

        return view('admin.surfaces.surfaceEdit', [
            'surface' => $surface,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function update(SurfaceRequest $request, Surface $surface)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Surface::class, $slug, $surface->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $surface->update([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $surface ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('surfaces.edit', $surface->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surface  $surface
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surface $surface)
    {
        $message = $surface->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('surfaces.index')->with('message', $message);
    }
}
