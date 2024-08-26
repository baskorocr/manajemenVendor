<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Project;
use App\Models\AssetType;
use App\Models\Proses;
use App\Models\Pemilik;
use App\Models\Photo; // Import Photo model if needed
use App\Models\Part;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with(['vendor', 'project', 'project.customer', 'assetType', 'proses', 'pemilik', 'photo', 'part', 'assetType'])->get();
        ;
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        $projects = Project::all();
        $assetTypes = AssetType::all();
        $proses = Proses::all();
        $pemiliks = Pemilik::all();
        $photos = Photo::all();
        $parts = Part::all(); // Assuming you have a Part model

        return view('assets.create', compact('vendors', 'projects', 'assetTypes', 'proses', 'pemiliks', 'photos', 'parts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'no_assets' => 'required|integer|max:10',
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'required|exists:projects,id',
            'asset_type_id' => 'required|exists:asset_types,id',
            'proses_id' => 'required|exists:proses,id',
            'pemiliks_id' => 'required|exists:pemiliks,id',
            'photo_id' => 'required|exists:photos,id',
            'idPart' => 'required|exists:parts,idPart',
            'jumlah' => 'required|integer',
        ]);






        Asset::create($request->all());


        return redirect()->route('assetsPart.index')
            ->with('success', 'Asset created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $vendors = Vendor::all();
        $projects = Project::all();
        $assetTypes = AssetType::all();
        $proses = Proses::all();
        $pemiliks = Pemilik::all();
        $photos = Photo::all(); // If you need to use the Photo model

        return view('assets.edit', compact('asset', 'vendors', 'projects', 'assetTypes', 'proses', 'pemiliks', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'required|exists:projects,id',
            'asset_type_id' => 'required|exists:asset_types,id',
            'proses_id' => 'required|exists:proses,id',
            'pemiliks_id' => 'required|exists:pemiliks,id',
            'photo_id' => 'required|exists:photos,id',
            'idPart' => 'required|exists:parts,idPart',
            'jumlah' => 'required|integer',
        ]);

        $asset->update($request->all());

        return redirect()->route('assetsPart.index')
            ->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the asset by its primary key
        $asset = Asset::findOrFail($id);

        // Delete the asset
        $asset->delete();

        // Redirect to the assets list with a success message
        return redirect()->route('assetsPart.index')->with('success', 'Asset deleted successfully.');
    }
}