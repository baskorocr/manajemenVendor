<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetTypes = AssetType::all();
        return view('asset_types.index', compact('assetTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_type' => 'required|string|max:255',
        ]);

        AssetType::create($request->all());

        return redirect()->route('asset-types.index')
            ->with('success', 'Asset Type created successfully.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetType $assetType)
    {
        return view('asset_types.edit', compact('assetType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetType $assetType)
    {
        $request->validate([
            'name_type' => 'required|string|max:255',
        ]);

        $assetType->update($request->all());

        return redirect()->route('asset-types.index')
            ->with('success', 'Asset Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetType $assetType)
    {
        $assetType->delete();

        return redirect()->route('asset-types.index')
            ->with('success', 'Asset Type deleted successfully.');
    }
}