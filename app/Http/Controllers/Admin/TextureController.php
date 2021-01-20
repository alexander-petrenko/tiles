<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Texture;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Requests\TextureCreateRequest;
use App\Http\Requests\TextureUpdateRequest;
use Illuminate\Support\Str;

class TextureController extends Controller
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
        
        $textures = Texture::all();
        
        return view('admin.textures.textures', [
            'textures' => $textures,
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

        return view('admin.textures.textureCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TextureCreateRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Texture::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $url = $this->imageSaver->upload($request, null, 'textures');

        $texture = Texture::create([
            'name' => $data['name'],
            'slug' => $slug,
            'url' => $url
        ]);

        $message = $texture ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('textures.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $texture = Texture::where('slug', $slug)->first();
        $collections = $texture->collections()->get();

        return view('admin.collections.collections', [
            'collections' => $collections
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $texture = Texture::where('slug', $slug)->first();

        return view('admin.textures.textureEdit', [
            'texture' => $texture,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function update(TextureUpdateRequest $request, Texture $texture)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Texture::class, $slug, $texture->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        if (!isset($data['image'])) {
            $texture->update([
                'name' => $data['name'],
                'slug' => $slug
            ]);
        } else {
            $url = $this->imageSaver->upload($request, $texture, 'textures');

            $texture->update([
                'name' => $data['name'],
                'slug' => $slug,
                'url' => $url
            ]);
        }

        $message = $texture ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('textures.edit', $texture->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Texture $texture)
    {
        $this->imageSaver->remove($texture, 'textures');

        $message = $texture->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('textures.index')->with('message', $message);
    }
}
