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
    //     if ($request->has('filter')) {
    //         dd($request->input('filter'));
    //     }
    //     $filter = trim($request->input('filter'));
    //     $kodeKriteriaMap = [
    //         'waktu' => 'C01',
    //         'jarak' => 'C02',
    //         'fasilitas' => 'C03',
    //     ];

    //     $kode_kriteria = $kodeKriteriaMap[$filter] ?? null;

    //     if (!$kode_kriteria) {
    //         return response()->json(['error' => 'Filter tidak valid'], 400);
    //     }

    //     $nilaiData = Nilai::with('alternatif', 'kriteria')
    //         ->where('kode_kriteria', $kode_kriteria)
    //         ->orderBy('nilai', in_array($filter, ['waktu', 'jarak']) ? 'asc' : 'desc')
    //         ->get();

    //     $filteredAlternatifIds = $nilaiData->pluck('kode_alternatif')->toArray();

    //     $allNilaiData = Nilai::with('alternatif', 'kriteria')
    //         ->whereIn('kode_alternatif', $filteredAlternatifIds)
    //         ->get();

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

    //     $sortedData = collect($groupedData)->sortBy(function ($item) use ($filter) {
    //         return $item[$filter];
    //     });

    //     if ($filter === 'fasilitas') {
    //         $sortedData = $sortedData->reverse();
    //     }

    //     // Konversi ke array indexed (bukan associative)
    //     return response()->json(array_values($sortedData->toArray()));
    // }

    public function filter(Request $request)
    {
        if (!$request->has('filter')) {
            return response()->json(['error' => 'Parameter filter diperlukan'], 400);
        }

        // Ambil input dan pisahkan kode_kriteria dan nilai acuan
        $filterInput = trim($request->input('filter')); // contoh: "C02-5"
        [$kode_kriteria, $target_nilai] = explode('-', $filterInput);

        // Validasi
        if (!in_array($kode_kriteria, ['C01', 'C02', 'C03']) || !is_numeric($target_nilai)) {
            return response()->json(['error' => 'Filter tidak valid'], 400);
        }

        $target_nilai = (float) $target_nilai;

        // Ambil semua data nilai sesuai kriteria
        $nilaiData = Nilai::with('alternatif', 'kriteria')
            ->where('kode_kriteria', $kode_kriteria)
            ->get();

        // Urutkan berdasarkan urutan nilai dari target ke bawah
        $nilaiData = $nilaiData->sortByDesc(function ($item) use ($target_nilai) {
            return -abs($item->nilai - $target_nilai);
        })->values();

        // Ambil semua kode alternatif hasil filter
        $filteredAlternatifIds = $nilaiData->pluck('kode_alternatif')->unique()->toArray();

        // Ambil ulang semua data untuk alternatif yang sudah terurut
        $allNilaiData = Nilai::with('alternatif', 'kriteria')
            ->whereIn('kode_alternatif', $filteredAlternatifIds)
            ->get();

        // Pemetaan kode_kriteria ke nama field
        $kategoriMap = [
            'C01' => 'waktu',
            'C02' => 'jarak',
            'C03' => 'fasilitas'
        ];

        // Kelompokkan data
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

        // Susun hasil berdasarkan urutan alternatif dari $nilaiData
        $finalData = [];
        foreach ($nilaiData as $nilai) {
            $kode = $nilai->kode_alternatif;
            if (isset($groupedData[$kode])) {
                $finalData[$kode] = $groupedData[$kode];
            }
        }

        return response()->json(array_values($finalData));
    }
}
