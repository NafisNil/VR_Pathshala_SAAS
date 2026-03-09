<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $benefits = Benefit::all();
        return view('backend.benefits.index', compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

       
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $benefit = Benefit::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            
        ]);

        if ($request->hasFile('icon')) {
            $benefit->icon = $this->uploadImage($request->file('icon'));
            $benefit->save();
        }

        return redirect()->route('benefits.index')->with('success', 'Benefit created successfully.');
    }

    /**
     * Handle the image upload process using Intervention Image.
     */
    protected function uploadImage($file, $path = 'backend/benefits/')
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

    /**
     * Display the specified resource.
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benefit $benefit)
    {
        //
        return view('backend.benefits.edit', compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Benefit $benefit)
    {
        //
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $benefit->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            
        ]);

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($benefit->icon) {
                // remove 'storage/' prefix to get the path relative to public disk
                $oldPath = str_replace('storage/', '', $benefit->icon);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $benefit->icon = $this->uploadImage($request->file('icon'));
            $benefit->save();
        }

        return redirect()->route('benefits.index')->with('success', 'Benefit updated successfully.');
    }

    public function destroy(Benefit $benefit)
    {
        //
        if ($benefit->icon) {
            $iconPath = str_replace('storage/', '', $benefit->icon);
            if (Storage::disk('public')->exists($iconPath)) {
                Storage::disk('public')->delete($iconPath);
            }
        }

        $benefit->delete();

        return redirect()->route('benefits.index')->with('success', 'Benefit deleted successfully.');
    }
}
