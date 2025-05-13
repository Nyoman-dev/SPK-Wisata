<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Nilai;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.alternatif', [
            'alternatif' => Alternatif::all()
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
        if (Alternatif::where('kode_alternatif', $request->kode_alternatif)->exists()) {
            return redirect()->back()->with('error', 'Kode alternatif sudah ada!');
        }
        if (Alternatif::where('nama_alternatif', $request->nama_alternatif)->exists()) {
            return redirect()->back()->with('error', 'Nama alternatif sudah ada!');
        }

        $validatedData = $request->validate([
            'kode_alternatif' => 'required|string|max:255|unique:alternatifs,kode_alternatif',
            'nama_alternatif' => 'required|max:255',
        ]);

        Alternatif::create($validatedData);
        return redirect()->back()->with('success', 'Data berhasil dtambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternatif $alternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        $rules = [
            'nama_alternatif' => 'required|string|max:255',
        ];
        if ($request->kode_alternatif != $alternatif->kode_alternatif) {
            $rules['kode_alternatif'] = 'required|string|max:255|unique:alternatifs,kode_alternatif';
        }
        if ($request->nama_alternatif == $alternatif->nama_alternatif && $request->kode_alternatif == $alternatif->kode_alternatif) {
            return redirect()->back()->with('error', 'Tidak ada perubahan Data!');
        }
        $validatedData = $request->validate($rules);
        Alternatif::where('kode_alternatif', $alternatif->kode_alternatif)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        // Alternatif::destroy($alternatif->id);
        $alternatif = Alternatif::find($alternatif->id); // Ganti $id dengan ID alternatif yang ingin dihapus

        if ($alternatif) {
            // Hapus semua nilai yang berelasi
            Nilai::where('kode_alternatif', $alternatif->kode_alternatif)->delete();

            // Hapus alternatif
            $alternatif->delete();
        }
        return redirect()->back()->with('success', 'Data Berhasil DiHapus');
    }
}
