<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use App\Models\Vendor;
use App\Models\Project;
use App\Models\AssetType;
use App\Models\Proses;
use App\Models\Pemilik;
use App\Models\Photo;
use App\Models\Part;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with(['vendor', 'project', 'project.customer', 'assetType', 'proses', 'pemilik', 'photo', 'part', 'assetType'])->get();
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
        $parts = Part::all();

        return view('assets.create', compact('vendors', 'projects', 'assetTypes', 'proses', 'pemiliks', 'photos', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_assets' => 'required|integer|digits_between:1,10',
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'required|exists:projects,id',
            'asset_type_id' => 'required|exists:asset_types,id',
            'proses_id' => 'required|exists:proses,id',
            'pemiliks_id' => 'required|exists:pemiliks,id',
            'photo_id' => 'required|exists:photos,id',
            'idPart' => 'required|exists:parts,idPart',
            'jumlah' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
    public function edit($no_assets)
    {
        $asset = Asset::where('no_assets', $no_assets)->firstOrFail();

        // Retrieve related data for the form
        $vendors = Vendor::all();
        $pemiliks = Pemilik::all();


        // Return the view with the asset and related data
        return view('assets.edit', compact('asset', 'vendors', 'pemiliks', ));
    }

    // Handle the form submission and update the asset in the database
    public function update(Request $request, $no_assets)
    {

        // Validate the request data
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Find the existing asset by its primary key
        $asset = Asset::where('no_assets', $no_assets)->firstOrFail();

        // Update the asset with the validated data
        if ($request->tempVendorAkhir != null) {
            Riwayat::create([
                'no_assets' => $request->no_asset,
                'idUser' => Auth::id(),
                'StatusAwal' => $request->tempVendorAwal,
                'StatusAkhir' => $request->tempVendorAkhir,

            ]);
            $asset->update([
                'vendor_id' => $validated['vendor_id'],
                'pemiliks_id' => $validated['pemilik_id'],
                'jumlah' => $validated['jumlah'],
            ]);



        } else {
            $asset->update([
                'vendor_id' => $validated['vendor_id'],
                'pemiliks_id' => $validated['pemilik_id'],
                'jumlah' => $validated['jumlah'],
            ]);
        }


        // Redirect the user with a success message
        return redirect()->route('assetsPart.index')->with('success', 'Asset updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assetsPart.index')->with('success', 'Asset deleted successfully.');
    }
}