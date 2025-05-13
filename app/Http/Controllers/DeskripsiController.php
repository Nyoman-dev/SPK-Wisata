<?php

namespace App\Http\Controllers;

use App\Models\Deskripsi;
use Illuminate\Http\Request;

class DeskripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.deskripsi', [
            'items' => Deskripsi::all()
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
            'alamat' => 'required',
            'map' => 'required',
            'deskripsi' => 'required',
        ]);
        Deskripsi::create($validatedData);
        return redirect()->back()->with('success', 'Data berhasil dtambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deskripsi $deskripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deskripsi $deskripsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deskripsi $deskripsi)
    {
        $validatedData = $request->validate([
            'judul' => 'required | string | min:3',
            'alamat' => 'required',
            'map' => 'required',
            'deskripsi' => 'required',
        ]);
        Deskripsi::where('id', $deskripsi->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deskripsi $deskripsi)
    {
        Deskripsi::destroy($deskripsi->id);
        return redirect()->back()->with('success', 'Data Berhasil DiHapus');
    }
}
