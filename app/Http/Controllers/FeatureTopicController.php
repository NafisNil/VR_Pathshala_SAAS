<?php

namespace App\Http\Controllers;

use App\Models\FeatureTopic;
use App\Models\ContentType;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class FeatureTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $feature_topics = FeatureTopic::all();
        return view('backend.feature_topics.index', compact('feature_topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $content_types = ContentType::all();
        return view('backend.feature_topics.create', compact('content_types'));
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
            'content_type_id' => 'required|exists:content_types,id',
           
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $feature_topic = FeatureTopic::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'content_type_id' => $request->content_type_id,
            'image' => $this->uploadImage($request->file('image')),
        ]);

        return redirect()->route('feature_topics.index')->with('success', 'Feature Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeatureTopic $featureTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeatureTopic $featureTopic)
    {
        $content_types = ContentType::all();
        return view('backend.feature_topics.edit', compact('featureTopic', 'content_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeatureTopic $featureTopic)
    {
        //
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'content_type_id' => 'required|exists:content_types,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $featureTopic->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'content_type_id' => $request->content_type_id,
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($featureTopic->image) {
                // remove 'storage/' prefix to get the path relative to public disk
                $oldPath = str_replace('storage/', '', $featureTopic->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $featureTopic->image = $this->uploadImage($request->file('image'));
            $featureTopic->save();
        }

        return redirect()->route('feature_topics.index')->with('success', 'Feature Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeatureTopic $featureTopic)
    {
        // Delete image if exists
        if ($featureTopic->image) {
            $oldPath = str_replace('storage/', '', $featureTopic->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $featureTopic->delete();

        return redirect()->route('feature_topics.index')->with('success', 'Feature Topic deleted successfully.');
    }


    protected function uploadImage($file, $path = 'backend/feature_topics/')
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
