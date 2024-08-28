<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user-manajemen.index', compact('users'));
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
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',NPK', // Adjust validation rule
            'is_admin' => 'required|boolean',
        ]);

        // Find the user by NPK
        $user = User::where('NPK', $id)->firstOrFail();

        // Update the user's attributes
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->is_admin = $validatedData['is_admin'];

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
}