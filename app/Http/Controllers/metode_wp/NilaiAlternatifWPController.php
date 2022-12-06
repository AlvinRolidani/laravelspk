<?php

namespace App\Http\Controllers\metode_wp;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\metode_wp\CripsWPModel;
use Illuminate\Support\Facades\Schema;
use App\Models\metode_wp\KriteriaWPModel;
use App\Models\metode_wp\AlternatifWPModel;
use App\Models\metode_wp\NilaiAlternatifWPModel;


class NilaiAlternatifWPController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'wp',
            'menu' => 'Nilai Alternatif',
            'alternatif' => AlternatifWPModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaWPModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria')->get(),
            'crips' => CripsWPModel::where('user_id', auth()->user()->id)->with('penilaian'),
            'jumlah' => KriteriaWPModel::where('user_id', auth()->user()->id)->count(),


        ];
        // return response()->json($data['alternatif']);
        $crips = CripsWPModel::where('user_id', auth()->user()->id)->get();


        if (count($crips) == 0 || count($data['alternatif']) == 0 || $data['jumlah'] == 0) {
            return redirect('metode/wp/alternatif');
        }
        // return response()->json($data['alternatif']);
        return view('metode_wp.nilai_alternatif.index', $data);
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
        NilaiAlternatifWPModel::insert($nilai);
        return redirect('/metode/wp/alternatif');
    }
    public function edit_nilai($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'wp',
            'menu' => 'Nilai Alternatif',
            'nilai' => NilaiAlternatifWPModel::with('crips')->where('alternatif_id', $id)->where('user_id', auth()->user()->id)->get(),

        ];
        // return response()->json($data['nilai']);
        return view('metode_wp.nilai_alternatif.edit_nilai', $data);
    }
    public function edit_nilai_alternatif(Request $request, $id)
    {
        $nilai = [
            'crips_id' => $request->crips_id
        ];
        // dd($nilai);
        NilaiAlternatifWPModel::where('alternatif_id', $id)->where('crips_id', $request->crips)->where('user_id', auth()->user()->id)->update($nilai);
        return redirect('/metode/wp/' . $id . '/edit_nilai');
    }
}
