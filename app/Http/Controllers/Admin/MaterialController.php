<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = session()->get('message') ?? NULL;
        
        $materials = Material::all();
        
        return view('admin.materials.materials', [
            'materials' => $materials,
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

        return view('admin.materials.materialCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Material::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $material = Material::create([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $material ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('materials.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $material = Material::where('slug', $slug)->first();

        return view('admin.materials.materialEdit', [
            'material' => $material,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, Material $material)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Material::class, $slug, $material->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $material->update([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $material ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('materials.edit', $material->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $message = $material->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('materials.index')->with('message', $message);
    }
}
