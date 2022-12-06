<?php

namespace App\Http\Controllers\metode_saw;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\metode_saw\KriteriaModel;
use App\Models\metode_saw\AlternatifSawModel;

class AlternatifController extends Controller
{
    public function alternatif_saw()
    {
        $kriteria = DB::table('kriteria_saw')->select('id', 'kode_kriteria', 'nama_kriteria')->get();
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_saw')->select('*')->where('user_id', auth()->user()->id)->get(),
            'kriteria' => KriteriaModel::where('user_id', auth()->user()->id)->with('crips')->orderBy('kode_kriteria')->get(),
            // 'nilai' => DB::table('kriteria_saw')->select('kriteria_saw.kode_kriteria', 'kriteria_saw.nama_kriteria', 'crips_saw.kriteria_id', 'crips_saw.crips', 'crips_saw.nilai')->leftjoin('crips_saw', 'kriteria_saw.kode_kriteria', '=', 'crips_saw.kriteria_id')->groupBy('kriteria_saw.kode_kriteria', 'crips_saw.kriteria_id')->orderByDesc('kriteria_saw.nama_kriteria', 'crips_saw.crips')->get()

        ];
        // return response()->json($data['kriteria']);

        return view('metode_saw.alternatif.alternatif', $data, compact('kriteria'));
    }
    public function tambah_alternatif()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_saw')->select('*')->where('user_id', auth()->user()->id)->get()
        ];
        $q = DB::table('alternatif_saw')->select(DB::raw('MAX(RIGHT(kode_alternatif,1)) as kode'))->where('user_id', auth()->user()->id);
        $kd = "";
        if ($q->count() > 0) {

            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf('%01s', $tmp);
            }
        } else {
            $kd = "1";
        }
        return view('metode_saw.alternatif.tambah_alternatif', $data, compact('kd'));
    }
    public function tambah_alternatif_saw(Request $request)
    {
        AlternatifSawModel::create([
            'kode_alternatif' => $request->kode_alternatif,
            'user_id' => auth()->user()->id,
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/saw/alternatif');
    }
    public function edit_alternatif($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Alternatif',
            'alternatif' => DB::table('alternatif_saw')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first(),
        ];
        return view('metode_saw.alternatif.edit_alternatif_saw', $data);
    }
    public function edit_alternatif_saw(Request $request, $id)
    {

        AlternatifSawModel::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'nama_alternatif' => $request->nama_alternatif
        ]);
        return redirect('/metode/saw/alternatif');
    }
}
