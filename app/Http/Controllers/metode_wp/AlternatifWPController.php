<?php

namespace App\Http\Controllers\metode_wp;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\metode_wp\KriteriaWPModel;
use App\Models\metode_wp\AlternatifWPModel;


class AlternatifWPController extends Controller
{
    public function alternatif_wp()
    {
        $kriteria = DB::table('kriteria_wp')->select('id', 'kode_kriteria', 'nama_kriteria')->get();
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_wp')->select('*')->where('user_id', auth()->user()->id)->get(),
            'kriteria' => KriteriaWPModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria')->get(),
            // 'nilai' => DB::table('kriteria_wp')->select('kriteria_wp.kode_kriteria', 'kriteria_wp.nama_kriteria', 'crips_wp.kriteria_id', 'crips_wp.crips', 'crips_wp.nilai')->leftjoin('crips_wp', 'kriteria_wp.kode_kriteria', '=', 'crips_wp.kriteria_id')->groupBy('kriteria_wp.kode_kriteria', 'crips_wp.kriteria_id')->orderByDesc('kriteria_wp.nama_kriteria', 'crips_wp.crips')->get()

        ];
        // return response()->json($data['kriteria']);

        return view('metode_wp.alternatif.alternatif', $data, compact('kriteria'));
    }
    public function tambah_alternatif()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_wp')->select('*')->where('user_id', auth()->user()->id)->get()
        ];
        $q = DB::table('alternatif_wp')->select(DB::raw('MAX(RIGHT(kode_alternatif,1)) as kode'))->where('user_id', auth()->user()->id);
        $kd = "";
        if ($q->count() > 0) {

            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf('%01s', $tmp);
            }
        } else {
            $kd = "1";
        }
        return view('metode_wp.alternatif.tambah_alternatif', $data, compact('kd'));
    }
    public function tambah_alternatif_wp(Request $request)
    {
        AlternatifWPModel::create([
            'kode_alternatif' => $request->kode_alternatif,
            'user_id' => auth()->user()->id,
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/wp/alternatif');
    }
    public function edit_alternatif($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_wp')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first(),
        ];
        return view('metode_wp.alternatif.edit_alternatif_wp', $data);
    }
    public function edit_alternatif_wp(Request $request, $id)
    {

        AlternatifWPModel::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/wp/alternatif');
    }
}
