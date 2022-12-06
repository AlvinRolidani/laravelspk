<?php

namespace App\Http\Controllers\metode_topsis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\metode_topsis\CripsTOPSISModel;
use App\Models\metode_topsis\KriteriaTOPSISModel;
use App\Models\metode_topsis\AlternatifTOPSISModel;
use App\Models\metode_topsis\NilaiAlternatifTOPSISModel;

class NilaiAlternatifTOPSISController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Nilai Alternatif',
            'alternatif' => AlternatifTOPSISModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaTOPSISModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria')->get(),
            'crips' => CripsTOPSISModel::where('user_id', auth()->user()->id)->with('penilaian'),
            'jumlah' => KriteriaTOPSISModel::where('user_id', auth()->user()->id)->count(),


        ];
        // return response()->json($data['alternatif']);
        $crips = CripsTOPSISModel::where('user_id', auth()->user()->id)->get();


        if (count($crips) == 0 || count($data['alternatif']) == 0 || $data['jumlah'] == 0) {
            return redirect('metode/topsis/alternatif');
        }
        // return response()->json($data['alternatif']);
        return view('metode_topsis.nilai_alternatif.index', $data);
    }
    public function nilai_alternatif(Request $request)
    {
        $nilai = [];

        foreach ($request->crips_id as $key => $value) {
            $nilai[] = [

                'user_id' => auth()->user()->id,
                'alternatif_id' => $request->alternatif_id,
                'crips_id' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        // dd($nilai);
        NilaiAlternatifTOPSISModel::insert($nilai);
        return redirect('/metode/topsis/alternatif');
    }
    public function edit_nilai($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Nilai Alternatif',
            'nilai' => NilaiAlternatifTOPSISModel::with('crips')->where('alternatif_id', $id)->where('user_id', auth()->user()->id)->get(),

        ];
        // return response()->json($data['nilai']);
        return view('metode_topsis.nilai_alternatif.edit_nilai', $data);
    }
    public function edit_nilai_alternatif(Request $request, $id)
    {
        $nilai = [
            'crips_id' => $request->crips_id
        ];
        // dd($nilai);
        NilaiAlternatifTOPSISModel::where('alternatif_id', $id)->where('crips_id', $request->crips)->where('user_id', auth()->user()->id)->update($nilai);
        return redirect('/metode/topsis/' . $id . '/edit_nilai');
    }
}
