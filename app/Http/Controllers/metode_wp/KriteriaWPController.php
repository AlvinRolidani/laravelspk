<?php

namespace App\Http\Controllers\metode_wp;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\metode_wp\CripsWPModel;

use Illuminate\Support\Facades\Schema;

use App\Models\metode_wp\KriteriaWPModel;
use Illuminate\Database\Schema\Blueprint;

class KriteriaWPController extends Controller
{
    public function kriteria_wp()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',
            'kriteria' => DB::table('kriteria_wp')->select('*')->where('user_id', auth()->user()->id)->get()
        ];
        return view('metode_wp.kriteria.kriteria', $data);
    }
    public function crips_wp($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',
            'crips' => CripsWPModel::where('kriteria_id', $id)->where('user_id', auth()->user()->id)->get(),
            'kriteria' => DB::table('kriteria_wp')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_wp.kriteria.crips', $data);
    }
    public function tambah_crips($id)
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',

            'kriteria' => DB::table('kriteria_wp')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_wp.kriteria.tambah_crips', $data);
    }
    public function tambah_kriteria_crips(Request $request, $id)
    {
        CripsWPModel::create([
            'kriteria_id' => $request->id,
            'user_id' => auth()->user()->id,
            'nama_kriteria' => ucwords($request->nama_kriteria),
            'crips' => ucwords($request->crips),
            'nilai' => $request->nilai
        ]);
        return redirect('/metode/wp/crips/' . $id);
    }
    public function tambah_kriteria_wp()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',


        ];
        $q = DB::table('kriteria_wp')->select(DB::raw('MAX(RIGHT(kode_kriteria,1)) as kode'))->where('user_id', auth()->user()->id);
        $kd = "";
        if ($q->count() > 0) {

            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf('%01s', $tmp);
            }
        } else {
            $kd = "1";
        }
        return view('metode_wp.kriteria.tambah_kriteria', $data, compact('kd'));
    }
    public function tambah_kriteria(Request $request)
    {

        KriteriaWPModel::create([
            'kode_kriteria' => $request->kode_kriteria,
            'user_id' => auth()->user()->id,
            'nama_kriteria' => ucwords($request->nama_kriteria),
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot' => $request->bobot
        ]);
        return redirect('/metode/wp/kriteria/');
    }
    public function edit_kriteria($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',

            'kriteria' => DB::table('kriteria_wp')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];
        return view('metode_wp.kriteria.edit_kriteria', $data);
    }
    public function edit_kriteria_wp(Request $request, $id)
    {
        KriteriaWPModel::where('id', $id)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot' => $request->bobot,
        ]);
        return redirect('metode/wp/kriteria');
    }
    public function edit_crips($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Kriteria',
            'crips' => CripsWPModel::find($id),
            'kriteria' => DB::table('kriteria_wp')->select('*')->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_wp.kriteria.edit_crips', $data);
    }
    public function edit_crips_wp(Request $request, $id)
    {
        $kriteria = DB::table('kriteria_wp')->select('id')->where('user_id', auth()->user()->id)->first();
        CripsWPModel::where('id', $id)->update([
            'crips' => $request->crips,
            'nilai' => $request->nilai,
        ]);
        return redirect('/metode/wp/crips/' . $kriteria->id);
    }
}
