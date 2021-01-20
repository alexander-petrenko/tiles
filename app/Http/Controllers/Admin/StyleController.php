<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StyleRequest;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = session()->get('message') ?? NULL;
        
        $styles = Style::all();
        
        return view('admin.styles.styles', [
            'styles' => $styles,
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

        return view('admin.styles.styleCreate', [
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StyleRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugCreateCheck(Style::class, $slug);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $style = Style::create([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $style ? ('Success' . $message) : ('Failed' . $message);

        return redirect()->route('styles.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $message = session()->get('message') ?? NULL;

        $style = Style::where('slug', $slug)->first();

        return view('admin.styles.styleEdit', [
            'style' => $style,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function update(StyleRequest $request, Style $style)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        $slugCheck = slugUpdateCheck(Style::class, $slug, $style->id);
        
        $slug = $slugCheck['slug'];
        $message = $slugCheck['message'];

        $style->update([
            'name' => $data['name'],
            'slug' => $slug
        ]);

        $message = $style ? ('Success' . $message) : ('Fail' . $message);

        return redirect()->route('styles.edit', $style->slug)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style)
    {
        $message = $style->delete() ? 'Success' : 'Failed';
        
        return redirect()->route('styles.index')->with('message', $message);
    }
}
