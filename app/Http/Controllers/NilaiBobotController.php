<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiBobot;
use Illuminate\Http\Request;

class NilaiBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.nilai-bobot', [
            'kriteria' => Kriteria::withCount('nilaibobot')->get()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiBobot $nilai_Bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiBobot $nilai_Bobot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiBobot $sub_Bobot)
    {
        $validatedData = $request->validate([
            'bobot_id' => 'required|array',
            'bobot_id.*' => 'required|integer',
            'nama' => 'required|array',
            'nama.*' => 'required|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer',
        ]);

        $nama = $validatedData['nama'];
        $nilai = $validatedData['nilai'];
        $bobotIds = $validatedData['bobot_id'];
        foreach ($bobotIds as $index => $bobotId) {
            $sub_bobot = NilaiBobot::find($bobotId);
            if ($sub_bobot) {
                $sub_bobot->update([
                    'nama' => $nama[$index],
                    'nilai' => $nilai[$index],
                ]);
            } else {
                return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan untuk ID: ' . $bobotId]);
            }
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiBobot $nilai_Bobot)
    {
        //
    }
}
