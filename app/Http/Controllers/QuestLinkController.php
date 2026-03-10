<?php

namespace App\Http\Controllers;

use App\Models\QuestLink;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
class QuestLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $questLinks = QuestLink::all();
        $questLinkCount = $questLinks->count();
        return view('backend.questLinks.index', compact('questLinks', 'questLinkCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.questLinks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'link' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $questLink = QuestLink::create([
            'link' => $request->link,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : null,
        ]);
        return redirect()->route('quest_links.index')->with('success', 'Quest Store Link created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestLink $questLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestLink $questLink)
    {
        return view('backend.questLinks.edit', compact('questLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestLink $questLink)
    {
        //
        $request->validate([
            'link' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $questLink->update([
            'link' => $request->link,
            'image' => $request->hasFile('image') ? $this->uploadImage($request->file('image')) : $questLink->image,
        ]);

        return redirect()->route('quest_links.index')->with('success', 'Quest Store Link updated successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestLink $questLink)
    {
        //
        if ($questLink->image) {
            $imagePath = str_replace('storage/', '', $questLink->image);
            Storage::disk('public')->delete($imagePath);
        }
        $questLink->delete();
        return redirect()->route('quest_links.index')->with('success', 'Quest Store Link deleted successfully.');
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
