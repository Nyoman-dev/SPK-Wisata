<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kriteria;
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
    //     // Ambil nilai dari request
    //     $filterJarak = $request->input('filter_jarak');
    //     $filterWaktu = $request->input('filter_waktu');
    //     $filterFasilitas = $request->input('filter_fasilitas');

    //     // Buat array untuk menyimpan kondisi filter
    //     $conditions = [];

    //     if ($filterJarak) {
    //         [$kodeKriteria, $nilai] = explode('-', $filterJarak);
    //         $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
    //     }
    //     if ($filterWaktu) {
    //         [$kodeKriteria, $nilai] = explode('-', $filterWaktu);
    //         $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
    //     }
    //     if ($filterFasilitas) {
    //         [$kodeKriteria, $nilai] = explode('-', $filterFasilitas);
    //         $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
    //     }

    //     // Jika tidak ada filter yang dipilih, kembalikan array kosong
    //     if (empty($conditions)) {
    //         return response()->json([]);
    //     }

    //     // Bangun query untuk mencari alternatif yang cocok dengan semua kondisi
    //     $query = Nilai::query();
    //     $firstCondition = array_shift($conditions);

    //     // Filter berdasarkan kondisi pertama
    //     $alternatifIds = $query->where('kode_kriteria', $firstCondition['kode_kriteria'])
    //         ->where('nilai', $firstCondition['nilai'])
    //         ->pluck('kode_alternatif');

    //     // Lakukan filter untuk kondisi yang tersisa
    //     foreach ($conditions as $condition) {
    //         $alternatifIds = Nilai::whereIn('kode_alternatif', $alternatifIds)
    //             ->where('kode_kriteria', $condition['kode_kriteria'])
    //             ->where('nilai', $condition['nilai'])
    //             ->pluck('kode_alternatif');
    //     }

    //     // Ambil data nilai lengkap untuk alternatif yang cocok
    //     $filteredNilais = Nilai::whereIn('kode_alternatif', $alternatifIds)
    //         ->with('alternatif', 'kriteria')
    //         ->get();

    //     // Mengelompokkan data berdasarkan alternatif dan memformat hasilnya
    //     $result = $filteredNilais->groupBy('kode_alternatif')->map(function ($group) {
    //         $alternatif = $group->first()->alternatif;
    //         $kriterias = [];

    //         foreach ($group as $nilaiItem) {
    //             // Ambil deskripsi nilai dari model NilaiBobot
    //             $deskripsiBobot = \App\Models\NilaiBobot::where('kode_kriteria', $nilaiItem->kode_kriteria)
    //                 ->where('nilai', $nilaiItem->nilai)
    //                 ->first();

    //             $kriterias[] = [
    //                 'kode_kriteria' => $nilaiItem->kode_kriteria,
    //                 'nama_kategori' => $nilaiItem->kriteria->nama_kriteria ?? $nilaiItem->kode_kriteria,
    //                 'deskripsi'     => $deskripsiBobot->nama ?? $nilaiItem->nilai,
    //             ];
    //         }

    //         return [
    //             'nama_alternatif' => $alternatif->nama_alternatif,
    //             'kriterias'       => $kriterias
    //         ];
    //     })->values();
    //     // dd($result);

    //     return response()->json($result);
    // }

    public function filter(Request $request)
    {
        $filterJarak = $request->input('filter_jarak');
        $filterWaktu = $request->input('filter_waktu');
        $filterFasilitas = $request->input('filter_fasilitas');

        // Buat array untuk menyimpan kondisi filter
        $conditions = [];

        if ($filterJarak) {
            [$kodeKriteria, $nilai] = explode('-', $filterJarak);
            $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
        }
        if ($filterWaktu) {
            [$kodeKriteria, $nilai] = explode('-', $filterWaktu);
            $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
        }
        if ($filterFasilitas) {
            [$kodeKriteria, $nilai] = explode('-', $filterFasilitas);
            $conditions[] = ['kode_kriteria' => $kodeKriteria, 'nilai' => $nilai];
        }

        // Jika tidak ada filter yang dipilih, kembalikan array kosong
        if (empty($conditions)) {
            return response()->json([]);
        }

        // Bangun query untuk mencari alternatif yang cocok dengan semua kondisi
        $query = Nilai::query();
        $firstCondition = array_shift($conditions);

        // Filter berdasarkan kondisi pertama
        $alternatifIds = $query->where('kode_kriteria', $firstCondition['kode_kriteria'])
            ->where('nilai', $firstCondition['nilai'])
            ->pluck('kode_alternatif');

        // Lakukan filter untuk kondisi yang tersisa
        foreach ($conditions as $condition) {
            $alternatifIds = Nilai::whereIn('kode_alternatif', $alternatifIds)
                ->where('kode_kriteria', $condition['kode_kriteria'])
                ->where('nilai', $condition['nilai'])
                ->pluck('kode_alternatif');
        }

        // Ambil data nilai lengkap untuk alternatif yang cocok
        $filteredNilais = Nilai::whereIn('kode_alternatif', $alternatifIds)
            ->with('alternatif', 'kriteria')
            ->get();

        // Mengelompokkan data berdasarkan alternatif dan memformat hasilnya
        $result = $filteredNilais->groupBy('kode_alternatif')->map(function ($group) {
            $alternatif = $group->first()->alternatif;
            $kriterias = [];

            foreach ($group as $nilaiItem) {
                // Ambil deskripsi nilai dari model NilaiBobot
                $deskripsiBobot = \App\Models\NilaiBobot::where('kode_kriteria', $nilaiItem->kode_kriteria)
                    ->where('nilai', $nilaiItem->nilai)
                    ->first();

                $kriterias[] = [
                    'kode_kriteria' => $nilaiItem->kode_kriteria,
                    'nama_kategori' => $nilaiItem->kriteria->nama_kriteria ?? $nilaiItem->kode_kriteria,
                    'deskripsi'     => $deskripsiBobot->nama ?? $nilaiItem->nilai,
                ];
            }

            return [
                'nama_alternatif' => $alternatif->nama_alternatif,
                'kriterias'       => $kriterias
            ];
        })->values();

        // ===  Hitung SAW hanya untuk kode_alternatif hasil filter ===
        $kriterias = [];
        $alternatifs = [];
        $nilais = [];
        foreach (Kriteria::all() as $kriteria)
            $kriterias[$kriteria->kode_kriteria] = $kriteria;
        foreach (Alternatif::all() as $alternatif)
            $alternatifs[$alternatif->kode_alternatif] = $alternatif;
        foreach (Nilai::with('alternatif')->orderBy('kode_alternatif')->orderBy('kode_kriteria')->get() as $nilai) {
            $nilais[$nilai->kode_alternatif]['name'] = $nilai->alternatif->nama_alternatif;
            $nilais[$nilai->kode_alternatif]['value'][$nilai->kode_kriteria] = $nilai->nilai;
        }

        $minmax = [];
        $arr = [];
        $normal = [];
        $terbobot = [];
        $total = [];
        $rank = [];

        foreach ($nilais as $key => $val) {
            foreach ($val['value'] as $k => $v) {
                if (isset($kriterias[$k])) {
                    $arr[$k][$key] = $v;
                }
            }
        }

        foreach ($arr as $key => $val) {
            $minmax[$key]['min'] = min($val);
            $minmax[$key]['max'] = max($val);
        }

        foreach ($nilais as $key => $val) {
            foreach ($val['value'] as $k => $v) {
                if (isset($kriterias[$k])) {
                    $normal[$key][$k] = strtolower($kriterias[$k]->atribut) == 'Benefit' ? $v / $minmax[$k]['max'] : $minmax[$k]['min'] / $v;
                }
            }
        }

        foreach ($normal as $key => $val) {
            foreach ($val as $k => $v) {
                if (isset($kriterias[$k])) {
                    $terbobot[$key][$k] = $v * $kriterias[$k]->bobot / 100;
                }
            }
        }

        foreach ($terbobot as $key => $val) {
            $total[$key] = array_sum($val);
        }

        arsort($total);

        $no = 1;
        foreach ($total as $key => $val) {
            $rank[$key] = $no++;
        }
        $rankedTotal = [];
        foreach ($rank as $kode_alternatif => $position) {
            $rankedTotal[$kode_alternatif] = [
                'rank' => $position,
                'total' => $total[$kode_alternatif],
                'name' => $nilais[$kode_alternatif]['name'],
                'kode_alternatif' => $kode_alternatif,
            ];
        }
        // ksort($total);
        usort($rankedTotal, function ($a, $b) {
            return $a['rank'] <=> $b['rank'];
        });

        // === Filter hasil SAW agar hanya kirim alternatif yang lolos filter ===
        $filteredRankedTotal = array_filter($rankedTotal, function ($item) use ($alternatifIds) {
            return in_array($item['kode_alternatif'], $alternatifIds->toArray());
        });

        // reindex array biar rapih (0,1,2,...)
        $filteredRankedTotal = array_values($filteredRankedTotal);

        return response()->json([
            'rankedTotal' => $filteredRankedTotal, // hanya alternatif sesuai filter
            'result' => $result                    // detail filter
        ]);
    }
}
