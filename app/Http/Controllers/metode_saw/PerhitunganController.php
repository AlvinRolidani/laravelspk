<?php

namespace App\Http\Controllers\metode_saw;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\metode_saw\CripsSawModel;
use App\Models\metode_saw\KriteriaModel;
use App\Models\metode_saw\AlternatifSawModel;
use App\Models\metode_saw\NilaiAlternatifModel;


class PerhitunganController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Perhitungan dan Rangking',
            'alternatif' => AlternatifSawModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria', 'ASC')->get(),
            'crips' => CripsSawModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'jumlah' => KriteriaModel::where('user_id', auth()->user()->id)->count(),
            'nilai' => NilaiAlternatifModel::where('user_id', auth()->user()->id)->with('crips', 'alternatif')->get()
        ];
        // dd($data['alternatif']);




        // return response()->json($data['nilai']);

        //minmax
        foreach ($data['kriteria'] as $value => $p) {
            foreach ($data['nilai'] as $i => $key) {
                if ($p->id == $key->crips->kriteria_id) {
                    if ($p->atribut_kriteria == 'cost') {
                        $minMax[$p->id][] = $key->crips->nilai;
                    } elseif ($p->atribut_kriteria == 'benefit')
                        $minMax[$p->id][] = $key->crips->nilai;
                }
            }
        }

        // dd($minMax);
        //normalisasi
        foreach ($data['nilai'] as $i => $key) {
            foreach ($data['kriteria'] as $p => $value) {
                if ($value->id == $key->crips->kriteria_id) {
                    if ($value->atribut_kriteria == 'cost') {
                        $normalisasi[$key->alternatif->nama_alternatif][$value->id] = min($minMax[$value->id]) / $key->crips->nilai;
                    } elseif ($value->atribut_kriteria == 'benefit')
                        $normalisasi[$key->alternatif->nama_alternatif][$value->id] = $key->crips->nilai / max($minMax[$value->id]);
                }
            }
        }
        // arsort($normalisasi);
        // return response()->json($normalisasi);
        //total
        foreach ($normalisasi as $key => $value) {
            foreach ($data['kriteria'] as $key_1 => $value_1) {

                $rank[$key][] = $value[$value_1->id] * $value_1->bobot;
            }
        }
        // dd($rank)
        $rangking = $normalisasi;
        foreach ($normalisasi as $key => $value) {

            $rangking[$key][] = array_sum($rank[$key]);
            arsort($rangking[$key]);
        }
        arsort($rangking);
        $newRank = $rangking;
        $i = 0;
        $last_v = null;
        foreach ($rangking as $k => $v) {
            if ($v != $last_v) {
                $i++;
                $last_v = $v;
            }
            $newRank[$k]['rank'] = $i;
        }

        // dd($newRank);
        $coll = collect($newRank);

        // arsort($rank);
        // $newRank = $rank;
        // $i = 0;
        // $last_v = null;
        // foreach ($rank as $k => $v) {
        //     if ($v != $last_v) {
        //         $i++;
        //         $last_v = $v;
        //     }
        //     $newRank[$k][] = $i;
        // }
        // $coll = collect($newRank);
        // dd($coll);
        return view('metode_saw.perhitungan.index', $data, compact('normalisasi', 'rangking', 'rank', 'coll'));
    }
}
