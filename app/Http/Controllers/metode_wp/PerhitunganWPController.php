<?php

namespace App\Http\Controllers\metode_wp;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\metode_wp\CripsWPModel;
use App\Models\metode_wp\KriteriaWPModel;
use App\Models\metode_wp\AlternatifWPModel;
use App\Models\metode_wp\NilaiAlternatifWPModel;



class PerhitunganWPController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Perhitungan dan Rangking',
            'alternatif' => AlternatifWPModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaWPModel::with('crips')->where('user_id', auth()->user()->id)->orderBy('kode_kriteria', 'ASC')->get(),
            'crips' => CripsWPModel::with('penilaian', 'kriteria')->where('user_id', auth()->user()->id)->get(),
            'jumlah' => KriteriaWPModel::where('user_id', auth()->user()->id)->count(),
            'nilai' => NilaiAlternatifWPModel::with('crips')->where('user_id', auth()->user()->id)->get()
        ];
        // dd($data['crips']);




        // return response()->json($data['alternatif']);

        //minmax
        // foreach ($data['kriteria'] as $item => $value) {
        //     $kriteria[$value->kode_kriteria][] = $value->bobot;
        // }
        // $hitung = $kriteria;
        // foreach ($kriteria as $item => $value) {
        //     $pp[$item] = array_sum($value[$item]);
        // }
        // return response()->json($pp);


        // return response()->json($hitung);


        $hitung = KriteriaWPModel::sum('bobot');
        $collect = collect($hitung);

        // dd($hitung);

        foreach ($data['kriteria'] as $item => $value_1) {
            foreach ($collect as $item_1 => $value) {

                if ($value_1->atribut_kriteria == 'cost') {
                    $bagiW[$value_1->id] = $value_1->bobot / (int)$value;
                } elseif ($value_1->atribut_kriteria == 'benefit') {
                    $bagiW[$value_1->id] = $value_1->bobot / (int)$value;
                }
            }
        }




        //NILAI W

        foreach ($data['nilai'] as $i => $key) {
            foreach ($data['kriteria'] as $p => $value) {
                if ($value->atribut_kriteria == 'cost') {
                    $nilaiW[$key->alternatif->nama_alternatif][$value->id] = $bagiW[$value->id] * -1;
                } elseif ($value->atribut_kriteria == 'benefit')
                    $nilaiW[$key->alternatif->nama_alternatif][$value->id] = $bagiW[$value->id] * 1;
            }
        }

        //NILAI S


        foreach ($data['alternatif'] as $key => $value) {
            foreach ($value->penilaian as $key_1 => $value_1) {
                foreach ($nilaiW as $key_2 => $value_2) {
                    $pangkat[$value->nama_alternatif][$value_1->crips->kriteria_id] = pow($value_1->crips->nilai, $value_2[$value_1->crips->kriteria_id]);
                }
            }
        }
        // dd($pangkat);
        $nilaiS = $pangkat;
        foreach ($nilaiW as $key => $value) {
            $nilaiS[$key]['total'] = array_product($pangkat[$key]);
        }


        //NILAI V
        $rangk = array_sum(array_column($nilaiS, 'total'));



        foreach ($nilaiW as $key => $value) {
            $nilaiV[$key][] = $nilaiS[$key]['total'] / $rangk;
            arsort($nilaiV[$key]);
        }
        arsort($nilaiV);



        $newRank = $nilaiV;
        $i = 0;
        $last_v = null;
        foreach ($nilaiV as $k => $v) {
            if ($v != $last_v) {
                $i++;
                $last_v = $v;
            }
            $newRank[$k]['rank'] = $i;
        }

        $hasilV = collect($newRank);




        return view('metode_wp.perhitungan.index', $data, compact('nilaiW', 'nilaiS', 'pangkat', 'hasilV'));
    }
}
