<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all parts
        $parts = Part::all();
        return view('parts.index', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form to create a new part
        return view('parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'part_name' => 'required|string|max:255',
            'spek_material' => 'required|string|max:255',

        ]);

        // Create a new part
        Part::create($request->all());

        // Redirect to parts list with success message
        return redirect()->route('parts.index')->with('success', 'Part created successfully.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the part to edit
        $part = Part::findOrFail($id);
        return view('parts.edit', compact('part'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // Validate the request
       $validatedData = $request->validate([
            'part_name' => 'required|string|max:255',
            'spek_material' => 'required|string|max:255',

        ]);

        // Update the part
        $part = Part::where('idPart',$id)->firstOrFail();
        $part->part_name = $validatedData['part_name'];
        $part->spek_material = $validatedData['spek_material'];

        $part->save();

        // Redirect to parts list with success message
        return redirect()->route('parts.index')->with('success', 'Part updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the part
        $part = Part::findOrFail($id);
        $part->delete();

        // Redirect to parts list with success message
        return redirect()->route('parts.index')->with('success', 'Part deleted successfully.');
    }
}