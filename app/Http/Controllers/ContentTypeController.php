<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ContentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contentTypes = ContentType::all();
        return view('backend.contentType.index', compact('contentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.contentType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        $contentType = ContentType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('contentTypes.index')->with('success', 'Content Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContentType $contentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentType $contentType)
    {
        //
        return view('backend.contentType.edit', compact('contentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentType $contentType)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        $contentType->update([
            'name' => $request->name,
        ]);
        return redirect()->route('contentTypes.index')->with('success', 'Content Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContentType $contentType)
    {
        //
        $contentType->delete();
        return redirect()->route('contentTypes.index')->with('success', 'Content Type deleted successfully.');
    }
}
