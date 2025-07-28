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

    public function filter(Request $request)
    {
        $filter = trim($request->input('filter'));

        $kodeKriteriaMap = [
            'waktu' => 'C01',
            'jarak' => 'C02',
            'fasilitas' => 'C03',
        ];

        $kode_kriteria = $kodeKriteriaMap[$filter] ?? null;

        if (!$kode_kriteria) {
            return response()->json(['error' => 'Filter tidak valid'], 400);
        }

        $nilaiData = Nilai::with('alternatif', 'kriteria')
            ->where('kode_kriteria', $kode_kriteria)
            ->orderBy('nilai', in_array($filter, ['waktu', 'jarak']) ? 'asc' : 'desc')
            ->get();

        $filteredAlternatifIds = $nilaiData->pluck('kode_alternatif')->toArray();

        $allNilaiData = Nilai::with('alternatif', 'kriteria')
            ->whereIn('kode_alternatif', $filteredAlternatifIds)
            ->get();

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

        $sortedData = collect($groupedData)->sortBy(function ($item) use ($filter) {
            return $item[$filter];
        });

        if ($filter === 'fasilitas') {
            $sortedData = $sortedData->reverse();
        }

        // Konversi ke array indexed (bukan associative)
        return response()->json(array_values($sortedData->toArray()));
    }
}
