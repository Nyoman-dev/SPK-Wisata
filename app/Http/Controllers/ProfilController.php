<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.profil', [
            'items' => Profil::all()
        ]);
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
        $validatedData = $request->validate([
            'judul' => 'required | string | min:3',
            'deskripsi' => 'required',
        ]);
        Profil::create($validatedData);
        return redirect()->back()->with('success', 'Data berhasil dtambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        $validatedData = $request->validate([
            'judul' => 'required | string | min:3',
            'deskripsi' => 'required',
        ]);
        Profil::where('id', $profil->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        Profil::destroy($profil->id);
        return redirect()->back()->with('success', 'Data Berhasil DiHapus');
    }
}
