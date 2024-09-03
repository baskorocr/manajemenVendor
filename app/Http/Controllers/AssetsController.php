<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use App\Models\Vendor;
use App\Models\Project;
use App\Models\AssetType;

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
        $assets = Asset::with(['vendor', 'project', 'project.customer', 'assetType', 'pemilik', 'photo', 'part', 'assetType'])->get();
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $data = '';

        if (!empty($searchTerm)) {
            $assets = Asset::with(['project.customer', 'vendor', 'photo', 'part', 'assetType', 'pemilik'])
                ->whereHas('project.customer', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhere('no_assets', 'LIKE', '%' . $searchTerm . '%')
                ->get();

            if ($assets->isEmpty()) {
                $data .= '<tr><td colspan="16" class="text-center">No data found.</td></tr>';
            } else {
                foreach ($assets as $key => $asset) {
                    $data .= '<tr>' .
                        '<td>' . ($key + 1) . '</td>' .
                        '<td>' . $asset->project->customer->name . '</td>' .
                        '<td>' . $asset->project->name_project . '</td>' .
                        '<td>' . optional($asset->vendor)->name_vendor . '</td>' .
                        '<td><img src="' . asset('storage/' . $asset->photo->path) . '" alt="Gambar" style="width: 4rem;"></td>' .
                        '<td>' . $asset->part->part_name . '</td>' .
                        '<td>' . $asset->part->idPart . '</td>' .
                        '<td>' . $asset->part->spek_material . '</td>' .
                        '<td>' . $asset->assetType->name_type . '</td>' .
                        '<td>' . $asset->Proses . '</td>' .
                        '<td>' . $asset->no_assets . '</td>' .
                        '<td>' . $asset->assetType->name_type . '</td>' .
                        '<td>' . $asset->jumlah . '</td>' .
                        '<td>' . $asset->machine . '</td>' .
                        '<td>' . optional($asset->pemilik)->name_pemilik . '</td>' .
                        '<td>' .
                        '<a href="' . route('assetsPart.edit', $asset->no_assets) . '" class="btn btn-warning btn-sm">Pindah Asset</a>' .
                        '<form action="' . route('assetsPart.destroy', $asset->no_assets) . '" method="POST" style="display:inline;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>' .
                        '</form>' .
                        '</td>' .
                        '</tr>';
                }
            }
        } else {
            $assets = Asset::with(['project.customer', 'vendor', 'photo', 'part', 'assetType', 'pemilik'])
                ->paginate(10);

            if ($assets->isEmpty()) {
                $data .= '<tr><td colspan="16" class="text-center">No data found.</td></tr>';
            } else {
                foreach ($assets as $key => $asset) {
                    $data .= '<tr>' .
                        '<td>' . ($key + 1) . '</td>' .
                        '<td>' . $asset->project->customer->name . '</td>' .
                        '<td>' . $asset->project->name_project . '</td>' .
                        '<td>' . optional($asset->vendor)->name_vendor . '</td>' .
                        '<td><img src="' . asset('storage/' . $asset->photo->path) . '" alt="Gambar" style="width: 4rem;"></td>' .
                        '<td>' . $asset->part->part_name . '</td>' .
                        '<td>' . $asset->part->idPart . '</td>' .
                        '<td>' . $asset->part->spek_material . '</td>' .
                        '<td>' . $asset->assetType->name_type . '</td>' .
                        '<td>' . $asset->Proses . '</td>' .
                        '<td>' . $asset->no_assets . '</td>' .
                        '<td>' . $asset->assetType->name_type . '</td>' .
                        '<td>' . $asset->jumlah . '</td>' .
                        '<td>' . $asset->machine . '</td>' .
                        '<td>' . optional($asset->pemilik)->name_pemilik . '</td>' .
                        '<td>' .
                        '<a href="' . route('assetsPart.edit', $asset->no_assets) . '" class="btn btn-warning btn-sm">Pindah Asset</a>' .
                        '<form action="' . route('assetsPart.destroy', $asset->no_assets) . '" method="POST" style="display:inline;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>' .
                        '</form>' .
                        '</td>' .
                        '</tr>';
                }
            }
        }

        return response()->json($data);
    }


    public function create()
    {
        $vendors = Vendor::all();
        $projects = Project::all();
        $assetTypes = AssetType::all();

        $pemiliks = Pemilik::all();
        $photos = Photo::all();
        $parts = Part::all();

        return view('assets.create', compact('vendors', 'projects', 'assetTypes', 'pemiliks', 'photos', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_assets' => 'required|string|max:255',
            'vendor_id' => 'required|exists:vendors,id',
            'project_id' => 'required|exists:projects,id',
            'asset_type_id' => 'required|exists:asset_types,id',

            'pemiliks_id' => 'required|exists:pemiliks,id',
            'photo_id' => 'required|exists:photos,id',
            'idPart' => 'required|exists:parts,idPart',
            'jumlah' => 'required|integer',
            'proses' => 'required|string',
            'machine' => 'required|string'
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation for image
        ]);

        // Find the existing asset by its primary key
        $asset = Asset::where('no_assets', $no_assets)->firstOrFail();

        // Handle the image upload for 'Riwayat'
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('riwayat', 'public');
        }

        // Update the asset with the validated data and create a 'Riwayat' entry if vendor changed
        if ($request->tempVendorAkhir != null) {
            Riwayat::create([
                'no_assets' => $request->no_asset,
                'idUser' => Auth::id(),
                'StatusAwal' => $request->tempVendorAwal,
                'StatusAkhir' => $request->tempVendorAkhir,
                'bukti' => $gambarPath, // Store the image path in 'Riwayat'
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