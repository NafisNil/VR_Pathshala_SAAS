<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $visions = Vision::all();
        $visionCount = $visions->count();
        return view('backend.visions.index', compact('visions', 'visionCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.visions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $vision = Vision::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : null,
        ]);

        return redirect()->route('visions.index')->with('success', 'Vision created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vision $vision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vision $vision)
    {
        //
        return view('backend.visions.edit', compact('vision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vision $vision)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $vision->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : $vision->image,
        ]);

        return redirect()->route('visions.index')->with('success', 'Vision updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vision $vision)
    {
        //
         if ($vision->image) {
            $imagePath = str_replace('storage/', '', $vision->image);
            Storage::disk('public')->delete($imagePath);
        }
        $vision->delete();
        return redirect()->route('visions.index')->with('success', 'Vision deleted successfully.');
    }

    protected function uploadImage($file, $path = 'backend/visions/')
    {
        if (!$file) {
            return null;
        }

        $manager = new ImageManager(new Driver());
        // Read the image using Intervention Image
        $image = $manager->read($file);

        // Generate a unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->guessExtension();
        
        // Ensure director exists in storage
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }

        // Absolute path to storage/app/public directory
        $directory = storage_path('app/public/' . $path);
        
        // Save the image
        $image->save($directory . $filename);

        return 'storage/' . $path . $filename;
    }
}
