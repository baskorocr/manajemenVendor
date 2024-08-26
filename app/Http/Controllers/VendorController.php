<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data vendor
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan vendor baru
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name_vendor' => 'required|string|max:255',
        ]);

        // Menyimpan data vendor baru
        Vendor::create($validatedData);

        // Redirect ke halaman daftar vendor dengan pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail vendor tertentu
        $vendor = Vendor::findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit vendor
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name_vendor' => 'required|string|max:255',
        ]);

        // Mengupdate data vendor
        Vendor::whereId($id)->update($validatedData);

        // Redirect ke halaman daftar vendor dengan pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data vendor
        Vendor::destroy($id);

        // Redirect ke halaman daftar vendor dengan pesan sukses
        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil dihapus');
    }
}