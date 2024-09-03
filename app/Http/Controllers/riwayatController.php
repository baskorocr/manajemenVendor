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
    public function search(Request $request)
    {
        \Log::info('Search query:', ['query' => $request->input('search')]);

        $query = $request->input('search');
        $riwayat = Riwayat::where('no_assets', 'LIKE', "%{$query}%")->with('user')
            ->get();
            

        \Log::info('Search results:', ['results' => $riwayat]);

        return response()->json($riwayat);
    }


}