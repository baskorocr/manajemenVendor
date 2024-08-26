<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemiliks = Pemilik::all();
        return view('pemiliks.index', compact('pemiliks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_pemilik' => 'required|string|max:255',
        ]);

        Pemilik::create([
            'name_pemilik' => $request->name_pemilik,
        ]);

        return redirect()->route('pemiliks.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_pemilik' => 'required|string|max:255',
        ]);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update([
            'name_pemilik' => $request->name_pemilik,
        ]);

        return redirect()->route('pemiliks.index')->with('success', 'Pemilik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('pemiliks.index')->with('success', 'Pemilik berhasil dihapus.');
    }
}