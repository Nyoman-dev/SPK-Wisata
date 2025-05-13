<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $nilaiData = Nilai::with('alternatif')->get();

        // Peta kode_kriteria ke kategori
        $kategoriMap = [
            'C01' => 'waktu',
            'C02' => 'jarak',
            'C03' => 'fasilitas'
        ];

        $groupedData = [];

        foreach ($nilaiData as $nilai) {
            $kode_alternatif = $nilai->kode_alternatif;
            $kategori = $kategoriMap[$nilai->kode_kriteria] ?? 'unknown';

            if (!isset($groupedData[$kode_alternatif])) {
                $groupedData[$kode_alternatif] = [
                    'nama_alternatif' => $nilai->alternatif->nama_alternatif ?? '',
                    'waktu' => null,
                    'jarak' => null,
                    'fasilitas' => null,
                ];
            }

            $groupedData[$kode_alternatif][$kategori] = $nilai->nilai;
        }

        return view('Pengunjung.filter', ['data' => $groupedData]);
    }

    // public function filter(Request $request)
    // {
    //     $filter = trim($request->input('filter'));

    //     // Map filter to kode_kriteria
    //     $kodeKriteriaMap = [
    //         'waktu' => 'C01',
    //         'jarak' => 'C02',
    //         'fasilitas' => 'C03',
    //     ];

    //     $kode_kriteria = $kodeKriteriaMap[$filter] ?? null;

    //     if (!$kode_kriteria) {
    //         // Jika filter tidak valid, kembalikan data kosong atau redirect
    //         return redirect()->back()->with('error', 'Filter tidak valid');
    //     }

    //     // Ambil data Nilai dengan relasi alternatif dan kriteria, filter berdasarkan kode_kriteria
    //     $nilaiData = Nilai::with('alternatif', 'kriteria')
    //         ->where('kode_kriteria', $kode_kriteria);

    //     // Urutkan berdasarkan filter
    //     if ($filter === 'waktu' || $filter === 'jarak') {
    //         $nilaiData = $nilaiData->orderBy('nilai', 'asc');
    //     } elseif ($filter === 'fasilitas') {
    //         $nilaiData = $nilaiData->orderBy('nilai', 'desc');
    //     }

    //     $filteredAlternatifIds = $nilaiData->pluck('kode_alternatif')->toArray();

    //     // Ambil semua data Nilai untuk alternatif yang sudah difilter
    //     $allNilaiData = Nilai::with('alternatif', 'kriteria')
    //         ->whereIn('kode_alternatif', $filteredAlternatifIds)
    //         ->get();

    //     // Peta kode_kriteria ke kategori
    //     $kategoriMap = [
    //         'C01' => 'waktu',
    //         'C02' => 'jarak',
    //         'C03' => 'fasilitas'
    //     ];

    //     $groupedData = [];

    //     foreach ($allNilaiData as $nilai) {
    //         $kode_alternatif = $nilai->kode_alternatif;
    //         $kategori = $kategoriMap[$nilai->kode_kriteria] ?? 'unknown';

    //         if (!isset($groupedData[$kode_alternatif])) {
    //             $groupedData[$kode_alternatif] = [
    //                 'nama_alternatif' => $nilai->alternatif->nama_alternatif ?? '',
    //                 'waktu' => null,
    //                 'jarak' => null,
    //                 'fasilitas' => null,
    //             ];
    //         }

    //         $groupedData[$kode_alternatif][$kategori] = $nilai->nilai;
    //     }

    //     // dd($groupedData);

    //     return view('Pengunjung.filter', ['data' => $groupedData]);
    // }

    public function filter(Request $request)
    {
        $filter = trim($request->input('filter'));

        // Map filter ke kode_kriteria
        $kodeKriteriaMap = [
            'waktu' => 'C01',
            'jarak' => 'C02',
            'fasilitas' => 'C03',
        ];

        $kode_kriteria = $kodeKriteriaMap[$filter] ?? null;

        if (!$kode_kriteria) {
            return redirect()->back()->with('error', 'Filter tidak valid');
        }

        // Ambil data nilai berdasarkan kriteria
        $nilaiData = Nilai::with('alternatif', 'kriteria')
            ->where('kode_kriteria', $kode_kriteria)
            ->orderBy('nilai', in_array($filter, ['waktu', 'jarak']) ? 'asc' : 'desc')
            ->get();

        $filteredAlternatifIds = $nilaiData->pluck('kode_alternatif')->toArray();

        // Ambil semua data nilai untuk alternatif yang sudah difilter
        $allNilaiData = Nilai::with('alternatif', 'kriteria')
            ->whereIn('kode_alternatif', $filteredAlternatifIds)
            ->get();

        // Map kode_kriteria ke kategori
        $kategoriMap = [
            'C01' => 'waktu',
            'C02' => 'jarak',
            'C03' => 'fasilitas'
        ];

        $groupedData = [];

        foreach ($allNilaiData as $nilai) {
            $kode_alternatif = $nilai->kode_alternatif;
            $kategori = $kategoriMap[$nilai->kode_kriteria] ?? 'unknown';

            if (!isset($groupedData[$kode_alternatif])) {
                $groupedData[$kode_alternatif] = [
                    'nama_alternatif' => $nilai->alternatif->nama_alternatif ?? '',
                    'waktu' => null,
                    'jarak' => null,
                    'fasilitas' => null,
                ];
            }

            $groupedData[$kode_alternatif][$kategori] = $nilai->nilai;
        }

        // Urutkan groupedData berdasarkan nilai sesuai filter
        $sortedData = collect($groupedData)->sortBy(function ($item) use ($filter) {
            return $item[$filter];
        });

        // Jika filter adalah fasilitas, balik urutan (desc)
        if ($filter === 'fasilitas') {
            $sortedData = $sortedData->reverse();
        }

        return view('Pengunjung.filter', ['data' => $sortedData]);
    }
}
