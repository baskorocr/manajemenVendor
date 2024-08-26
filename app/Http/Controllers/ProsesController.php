<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proses;

class ProsesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data proses
        $proses = Proses::all();
        return view('proses.index', compact('proses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan proses baru
        return view('proses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'proses_name' => 'required|string|max:255',
        ]);

        // Menyimpan data proses baru
        Proses::create($validatedData);

        // Redirect ke halaman daftar proses dengan pesan sukses
        return redirect()->route('proses.index')->with('success', 'Proses berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail proses tertentu
        $proses = Proses::findOrFail($id);
        return view('proses.show', compact('proses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit proses
        $proses = Proses::findOrFail($id);
        return view('proses.edit', compact('proses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'proses_name' => 'required|string|max:255',
        ]);

        // Mengupdate data proses
        Proses::whereId($id)->update($validatedData);

        // Redirect ke halaman daftar proses dengan pesan sukses
        return redirect()->route('proses.index')->with('success', 'Proses berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data proses
        Proses::destroy($id);

        // Redirect ke halaman daftar proses dengan pesan sukses
        return redirect()->route('proses.index')->with('success', 'Proses berhasil dihapus');
    }
}