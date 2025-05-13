<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = [];
        $alternatifs = [];
        $nilais = [];

        foreach (Kriteria::with(['nilaibobot' => fn($query) => $query->select('id', 'nama', 'kode_kriteria', 'nilai')])->select('id', 'kode_kriteria', 'nama_kriteria')->get() as $kriteria) {
            $kriterias[$kriteria->kode_kriteria] = $kriteria;
        }
        $usedAlternatives = Nilai::pluck('kode_alternatif')->toArray();

        $alternatifs = Alternatif::whereNotIn('kode_alternatif', $usedAlternatives)->select('id', 'kode_alternatif', 'nama_alternatif')->get();

        foreach (Nilai::with('alternatif')->orderBy('kode_alternatif')->orderBy('kode_kriteria')->get() as $nilai) {
            $nilais[$nilai->kode_alternatif]['name'] = $nilai->alternatif->nama_alternatif;
            $nilais[$nilai->kode_alternatif]['value'][$nilai->kode_kriteria] = $nilai->nilai;
        }
        return view('Dashboard.matriks-keputusan', compact('kriterias', 'alternatifs', 'nilais'));
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
            'kode_alternatif' => 'required|string',
            'kode_kriteria' => 'required|array',
            'nilai' => 'required|array',
        ]);
        $kodeAlternatif = $request->input('kode_alternatif');
        foreach ($request->input('kode_kriteria') as $kodeKriteria) {
            $nilai = $request->input('nilai')[$kodeKriteria][0];
            Nilai::create([
                'kode_alternatif' => $kodeAlternatif,
                'kode_kriteria' => $kodeKriteria,
                'nilai' => $nilai
            ]);
        }
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $hasil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $hasil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $hasil)
    {
        $validatedData = $request->validate(
            [
                'kode_alternatif' => 'required|string',
                'kode_kriteria' => 'required|array',
                'nilai' => 'required|array',

            ]
        );
        $kodeAlternatif = $validatedData['kode_alternatif'];
        foreach ($validatedData['kode_kriteria'] as $index => $kodeKriteria) {
            $kriteria = Nilai::where('kode_alternatif', $kodeAlternatif)
                ->where('kode_kriteria', $kodeKriteria)->first();
            if ($kriteria) {
                $kriteria->update([
                    'nilai' => $validatedData['nilai'][$kodeKriteria][0],
                ]);
            } else {
                return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan untuk Kode Alternatif: ' . $kodeAlternatif . ' dan Kode Kriteria: ' . $kodeKriteria]);
            }
        }
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $hasil)
    {
        //
    }
}
