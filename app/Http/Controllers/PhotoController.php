<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::all(); // Retrieve all photos
        return view('photos.index', compact('photos')); // Replace with your Blade view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photos.create'); // Replace with your Blade view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Validate the file type and size
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photos', 'public'); // Save file in the 'photos' directory

            // Create a new photo record in the database
            Photo::create([
                'path' => $path,
                'name' => $file->getClientOriginalName(), // Use the original name of the file
            ]);

            return redirect()->route('photos.index')->with('success', 'Photo uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload photo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.show', compact('photo')); // Replace with your Blade view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.edit', compact('photo')); // Replace with your Blade view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $photo = Photo::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Validate the file type and size
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old file
            Storage::disk('public')->delete($photo->path);

            $file = $request->file('photo');
            $path = $file->store('photos', 'public'); // Save file in the 'photos' directory

            $photo->update([
                'path' => $path,
                'name' => $file->getClientOriginalName(), // Use the original name of the file
            ]);
        } else {
            $photo->update([
                'name' => $request->input('name'),
            ]);
        }

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = Photo::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($photo->path);

        // Delete the record from the database
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }
}