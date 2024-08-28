<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class riwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayat = Riwayat::with('user')->get();
        return view('riwayat.index', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $riwayat = Riwayat::findOrFail($id);

        // Delete the Riwayat record
        $riwayat->delete();

        // Redirect back to the index page with a success message

        return redirect()->route('riwayat.index')->with('success', 'Proses berhasil dihapus');
    }
}