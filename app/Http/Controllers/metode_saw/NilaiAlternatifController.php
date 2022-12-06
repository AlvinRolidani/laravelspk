<?php

namespace App\Http\Controllers\metode_saw;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;
use App\Models\metode_saw\CripsSawModel;
use App\Models\metode_saw\KriteriaModel;
use App\Models\metode_saw\AlternatifSawModel;
use App\Models\metode_saw\NilaiAlternatifModel;

class NilaiAlternatifController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Nilai Alternatif',
            'alternatif' => AlternatifSawModel::where('user_id', auth()->user()->id)->with('penilaian.crips')->get(),
            'kriteria' => KriteriaModel::where('user_id', auth()->user()->id)->with('crips.penilaian')->orderBy('kode_kriteria')->get(),
            'crips' => CripsSawModel::where('user_id', auth()->user()->id)->with('penilaian'),
            'jumlah' => KriteriaModel::where('user_id', auth()->user()->id)->count(),


        ];
        // return response()->json($data['alternatif']);
        $crips = CripsSawModel::where('user_id', auth()->user()->id)->get();


        if (count($crips) == 0 || count($data['alternatif']) == 0 || $data['jumlah'] == 0) {
            return redirect('metode/saw/alternatif');
        }
        // return response()->json($data['alternatif']);
        return view('metode_saw.nilai_alternatif.index', $data);
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
        NilaiAlternatifModel::insert($nilai);
        return redirect('/metode/saw/alternatif');
    }
    public function edit_nilai($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Nilai Alternatif',
            'nilai' => NilaiAlternatifModel::with('crips')->where('alternatif_id', $id)->where('user_id', auth()->user()->id)->get(),

        ];
        // return response()->json($data['nilai']);
        return view('metode_saw.nilai_alternatif.edit_nilai', $data);
    }
    public function edit_nilai_alternatif(Request $request, $id)
    {
        $nilai = [
            'crips_id' => $request->crips_id
        ];
        // dd($nilai);
        NilaiAlternatifModel::where('alternatif_id', $id)->where('crips_id', $request->crips)->where('user_id', auth()->user()->id)->update($nilai);
        return redirect('/metode/saw/' . $id . '/edit_nilai');
    }
}
