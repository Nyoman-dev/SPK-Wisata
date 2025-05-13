<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kriteria;
use App\Models\Alternatif;

class SpkController extends Controller
{
    public function index()
    {
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
                    $normal[$key][$k] = strtolower($kriterias[$k]->atribut) == 'benefit' ? $v / $minmax[$k]['max'] : $minmax[$k]['min'] / $v;
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

        return view('dashboard.hasil-perhitungan', compact('kriterias', 'alternatifs', 'nilais', 'minmax', 'normal', 'terbobot', 'rankedTotal'));
    }
}
