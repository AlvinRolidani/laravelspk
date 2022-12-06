<?php

namespace App\Http\Controllers\metode_topsis;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\metode_topsis\KriteriaTOPSISModel;
use App\Models\metode_topsis\AlternatifTOPSISModel;

class AlternatifTOPSISController extends Controller
{
    public function alternatif_topsis()
    {
        $kriteria = DB::table('kriteria_topsis')->select('id', 'kode_kriteria', 'nama_kriteria')->get();
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_topsis')->select('*')->where('user_id', auth()->user()->id)->get(),
            'kriteria' => KriteriaTOPSISModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria')->get(),
            // 'nilai' => DB::table('kriteria_topsis')->select('kriteria_topsis.kode_kriteria', 'kriteria_topsis.nama_kriteria', 'crips_topsis.kriteria_id', 'crips_topsis.crips', 'crips_topsis.nilai')->leftjoin('crips_topsis', 'kriteria_topsis.kode_kriteria', '=', 'crips_topsis.kriteria_id')->groupBy('kriteria_topsis.kode_kriteria', 'crips_topsis.kriteria_id')->orderByDesc('kriteria_topsis.nama_kriteria', 'crips_topsis.crips')->get()

        ];
        // return response()->json($data['kriteria']);

        return view('metode_topsis.alternatif.alternatif', $data, compact('kriteria'));
    }
    public function tambah_alternatif()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_topsis')->select('*')->where('user_id', auth()->user()->id)->get()
        ];
        $q = DB::table('alternatif_topsis')->select(DB::raw('MAX(RIGHT(kode_alternatif,1)) as kode'))->where('user_id', auth()->user()->id);
        $kd = "";
        if ($q->count() > 0) {

            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf('%01s', $tmp);
            }
        } else {
            $kd = "1";
        }
        return view('metode_topsis.alternatif.tambah_alternatif', $data, compact('kd'));
    }
    public function tambah_alternatif_topsis(Request $request)
    {
        AlternatifTOPSISModel::create([
            'kode_alternatif' => $request->kode_alternatif,
            'user_id' => auth()->user()->id,
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/topsis/alternatif');
    }
    public function edit_alternatif($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_topsis')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first(),
        ];
        return view('metode_topsis.alternatif.edit_alternatif_topsis', $data);
    }
    public function edit_alternatif_topsis(Request $request, $id)
    {

        AlternatifTOPSISModel::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/topsis/alternatif');
    }
}
