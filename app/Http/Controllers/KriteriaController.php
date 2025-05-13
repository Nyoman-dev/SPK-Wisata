<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\NilaiBobot;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.kriteria', [
            'kriteria' => Kriteria::all(),
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
        if (Kriteria::where('kode_kriteria', $request->kode_kriteria)->exists()) {
            return redirect()->back()->with('error', 'Kode kriteria sudah ada!');
        }
        if (Kriteria::where('nama_kriteria', $request->nama_kriteria)->exists()) {
            return redirect()->back()->with('error', 'Nama kriteria sudah ada!');
        }

        $validatedData = $request->validate([
            'kode_kriteria' => 'required|string|max:255|unique:kriterias,kode_kriteria',
            'nama_kriteria' => 'required|max:255',
            'bobot' => 'required|numeric',
            'atribut' => 'required',
        ]);
        $validatedData['bobot_normalisasi'] = $validatedData['bobot'] / 100;
        $kriteria = Kriteria::create($validatedData);
        $nama = strtolower($kriteria->nama_kriteria);
        $nilaiBobots = [];

        if ($nama === 'fasilitas') {
            $nilaiBobots = [
                ['nama' => 'Tidak Lengkap', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 1],
                ['nama' => 'Cukup Lengkap', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 3],
                ['nama' => 'Sangat Lengkap', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 5],
            ];
        } elseif ($nama === 'jarak') {
            $nilaiBobots = [
                ['nama' => '<=1 km', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 5],
                ['nama' => '2-5 km', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 3],
                ['nama' => '>5 km', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 1],
            ];
        } elseif ($nama === 'waktu') {
            $nilaiBobots = [
                ['nama' => '<=10 menit', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 5],
                ['nama' => '11-20 menit', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 3],
                ['nama' => '>20 menit', 'kode_kriteria' => $kriteria->kode_kriteria, 'nilai' => 1],
            ];
        }
        foreach ($nilaiBobots as $nilaiBobot) {
            NilaiBobot::create($nilaiBobot);
        }
        $alternatives = Alternatif::all();
        foreach ($alternatives as $alternative) {
            Nilai::create([
                'kode_alternatif' => $alternative->kode_alternatif,
                'kode_kriteria' => $kriteria->kode_kriteria,
                'nilai' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil dtambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $rules = [
            'nama_kriteria' => 'required|max:255|string',
            'atribut' => 'required|string',
        ];
        if ($request->kode_kriteria !== $kriterium->kode_kriteria) {
            $rules['kode_kriteria'] = 'required|string|max:255|unique:kriterias,kode_kriteria';
        }
        if ($request->bobot !== $kriterium->bobot) {
            $rules['bobot'] = 'required';
        }
        if ($request->nama_kriteria == $kriterium->nama_kriteria && $request->kode_kriteria == $kriterium->kode_kriteria && $request->bobot == $kriterium->bobot && $request->atribut == $kriterium->atribut) {
            return redirect()->back()->with('error', 'Tidak ada perubahan Data!');
        }
        $validatedData = $request->validate($rules);
        $validatedData['bobot_normalisasi'] = $request->bobot / 100;
        Kriteria::find($kriterium->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        NilaiBobot::where('kode_kriteria', $kriterium->kode_kriteria)->delete();
        Kriteria::destroy($kriterium->id);
        return redirect()->back()->with('success', 'Data Berhasil DiHapus');
    }
}
