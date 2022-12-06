<?php

namespace App\Http\Controllers\metode_topsis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\metode_topsis\CripsTOPSISModel;
use App\Models\metode_topsis\KriteriaTOPSISModel;
use App\Models\metode_topsis\AlternatifTOPSISModel;
use App\Models\metode_topsis\NilaiAlternatifTOPSISModel;

class PerhitunganTOPSISController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Perhitungan dan Rangking',
            'alternatif' => AlternatifTOPSISModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaTOPSISModel::with('crips')->where('user_id', auth()->user()->id)->orderBy('kode_kriteria', 'ASC')->get(),
            'crips' => CripsTOPSISModel::with('penilaian', 'kriteria')->where('user_id', auth()->user()->id)->get(),
            'jumlah' => KriteriaTOPSISModel::where('user_id', auth()->user()->id)->count(),
            'nilai' => NilaiAlternatifTOPSISModel::with('crips')->where('user_id', auth()->user()->id)->get()
        ];
        // return response()->json($data['alternatif']);
        $hitung = KriteriaTOPSISModel::sum('bobot');
        $collect = collect($hitung);



        foreach ($data['nilai'] as $i => $key) {
            foreach ($data['kriteria'] as $p => $value) {
                if ($value->id == $key->crips->kriteria_id) {

                    // $normalisasi[$key->alternatif->nama_alternatif][$value->id] =  $key->crips->nilai;
                    $normalisasi[$value->id] = $value->bobot;
                }
            }
        }



        foreach ($data['kriteria'] as $value_1 => $item) {
            foreach ($normalisasi as $key => $value) {
                $p = array_sum($normalisasi);

                $hasil[$key] =  $normalisasi[$key] / $p;
            }
        }


        // return response()->json($data['alternatif'])
        //PEMBAGI

        foreach ($data['alternatif'] as $key => $value) {
            foreach ($value->penilaian as $key_1 => $value_1) {
                $pangkat[$value_1->crips->kriteria_id][] = pow($value_1->crips->nilai, 2);
            }
        }

        $hasilKuadrat = $pangkat;
        foreach ($pangkat as $key => $value) {
            $hasilKuadrat[$key]['total'] = array_sum($pangkat[$key]);
        }

        foreach ($hasilKuadrat as $key => $value) {
            $hasilAkar[$key][] = round(sqrt($hasilKuadrat[$key]['total']), 5);
        }


        //NORMALISASI TERBAGI
        foreach ($data['alternatif'] as $key => $value) {
            foreach ($value->penilaian as $key_1 => $value_1) {

                $normalisasiterbagi[$value->nama_alternatif][$value_1->crips->kriteria_id] = round($value_1->crips->nilai / $hasilAkar[$value_1->crips->kriteria_id][0], 5);
            }
        }


        //NORMALISASI TERBOBOT
        //Matriks Solusi Ideal
        foreach ($normalisasiterbagi as $key => $value) {
            foreach ($data['kriteria'] as $item => $value_1) {
                $solusi[$value_1->id][] = $value[$value_1->id] * $hasil[$value_1->id];
                $solusi_ideal[$key][$value_1->id] = $value[$value_1->id] * $hasil[$value_1->id];
            }
        }



        foreach ($data['kriteria'] as $item => $value_1) {

            if ($value_1->atribut_kriteria == 'cost') {
                $Amax[$value_1->nama_kriteria] = min($solusi[$value_1->id]);
                $Amin[$value_1->nama_kriteria] = max($solusi[$value_1->id]);
            } elseif ($value_1->atribut_kriteria == 'benefit') {
                $Amax[$value_1->nama_kriteria] = max($solusi[$value_1->id]);
                $Amin[$value_1->nama_kriteria] = min($solusi[$value_1->id]);
            }
        }



        //D+ dan D-
        foreach ($data['alternatif'] as $key => $value) {
            foreach ($value->penilaian as $item => $crips) {

                //D+
                $dplus[$value->nama_alternatif][$crips->crips->kriteria_id] = pow($solusi_ideal[$value->nama_alternatif][$crips->crips->kriteria_id] - $Amax[$crips->crips->nama_kriteria], 2);
                $tambahDplus[$value->nama_alternatif] = array_sum($dplus[$value->nama_alternatif]);
                $totalDplus[$value->nama_alternatif] = sqrt($tambahDplus[$value->nama_alternatif]);

                //D-

                $dmin[$value->nama_alternatif][$crips->crips->kriteria_id] = pow($Amin[$crips->crips->nama_kriteria] - $solusi_ideal[$value->nama_alternatif][$crips->crips->kriteria_id], 2);
                $tambahDmin[$value->nama_alternatif] = array_sum($dmin[$value->nama_alternatif]);
                $totalDmin[$value->nama_alternatif] = sqrt($tambahDmin[$value->nama_alternatif]);
            }
        }
        // dd($totalDmin);
        foreach ($data['alternatif'] as $key => $value) {

            $preferensi[$value->nama_alternatif][] = round($totalDmin[$value->nama_alternatif] / ($totalDmin[$value->nama_alternatif] + $totalDplus[$value->nama_alternatif]), 5);
        }
        arsort($preferensi);

        $newRank = $preferensi;
        $i = 0;
        $last_v = null;
        foreach ($preferensi as $k => $v) {
            if ($v != $last_v) {
                $i++;
                $last_v = $v;
            }
            $newRank[$k]['rank'] = $i;
        }

        foreach ($totalDmin as $item => $value) {
            $kombi[$item][] = $value;
        }


        $merge_array = $kombi;
        foreach ($totalDplus as $item => $value) {
            $merge_array[$item][] = $value;
        }

        $rank = collect($newRank);


        // dd($dmin, $tambahDmin, $totalDmin, $solusi_ideal, $Amax, $Amin);

        // dd($totalDmin);




        // return view('metode_topsis.topsis', $data, compact('totalDmin', 'nilaiS', 'pangkat', 'hasilV'));
        return view('metode_topsis.perhitungan.index', $data, compact('totalDmin', 'rank', 'hasilAkar', 'normalisasiterbagi', 'solusi_ideal', 'Amax', 'Amin', 'merge_array'));
    }
}
