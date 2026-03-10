<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $objectives = Objective::all();
        $objectiveCount = $objectives->count();
        return view('backend.objectives.index', compact('objectives', 'objectiveCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.objectives.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $objective = Objective::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : null,
        ]);

        return redirect()->route('objectives.index')->with('success', 'Objective created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Objective $objective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Objective $objective)
    {
        //
        return view('backend.objectives.edit', compact('objective'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Objective $objective)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $objective->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : $objective->image,
        ]);

        return redirect()->route('objectives.index')->with('success', 'Objective updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Objective $objective)
    {
         // Delete image if exists
        if ($objective->image) {
            $oldPath = str_replace('storage/', '', $objective->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $objective->delete();

        return redirect()->route('objectives.index')->with('success', 'Objective deleted successfully.');
    }

    protected function uploadImage($file, $path = 'backend/objectives/')
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
