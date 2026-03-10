<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $missions = Mission::all();
        $missionCount = $missions->count();
        return view('backend.missions.index', compact('missions', 'missionCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.missions.create');
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

        $mission = Mission::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : null,
        ]);

        return redirect()->route('missions.index')->with('success', 'Mission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //
        return view('backend.missions.edit', compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $mission->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : $mission->image,
        ]);

        return redirect()->route('missions.index')->with('success', 'Mission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
        if ($mission->image) {
            $imagePath = str_replace('storage/', '', $mission->image);
            Storage::disk('public')->delete($imagePath);
        }
        $mission->delete();
        return redirect()->route('missions.index')->with('success', 'Mission deleted successfully.');
    }

    protected function uploadImage($file, $path = 'backend/mission/')
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
