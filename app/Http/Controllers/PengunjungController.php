<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Profil;
use App\Models\Kriteria;
use App\Models\Deskripsi;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function home()
    {
        return view('Pengunjung.home');
    }

    public function profil()
    {
        return view('Pengunjung.profil', [
            'data' => Profil::all()
        ]);
    }

    public function deskripsi()
    {
        return view('Pengunjung.deskripsi', [
            'data' => Deskripsi::all()
        ]);
    }

    public function filter()
    {
        return view('Pengunjung.filter');
    }

    public function rekomendasi()
    {
        $labelMap = \App\Models\NilaiBobot::select('kode_kriteria', 'nilai', 'nama')
            ->get()
            ->groupBy('kode_kriteria')
            ->map(fn($g) => $g->keyBy('nilai'));

        $kriteriaNilai = [];

        $items = \App\Models\Nilai::with('alternatif')
            ->orderBy('kode_alternatif')
            ->orderBy('kode_kriteria')
            ->get();

        foreach ($items as $n) {
            $kriteriaNilai[$n->kode_alternatif]['name'] = $n->alternatif->nama_alternatif;

            $nama = $labelMap[$n->kode_kriteria][$n->nilai]->nama ?? '-';

            $kriteriaNilai[$n->kode_alternatif]['value'][$n->kode_kriteria] = [
                'nilai' => (float) $n->nilai,
                'nama'  => $nama,
            ];
        }

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
        // dd($kriteriaNilai);

        return view('Pengunjung.rekomendasi', [
            'datas' => $kriteriaNilai,
            'rankedTotal' => $rankedTotal
        ]);
    }

    public function detail($slug)
    {
        return view('Pengunjung.detail-wisata', [
            'data' => Deskripsi::where('slug', $slug)->get()
        ]);
    }
}
