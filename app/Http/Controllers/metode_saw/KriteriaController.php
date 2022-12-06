<?php

namespace App\Http\Controllers\metode_saw;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Models\metode_saw\CripsSawModel;
use App\Models\metode_saw\KriteriaModel;
use Illuminate\Database\Schema\Blueprint;

class KriteriaController extends Controller
{
    public function kriteria_saw()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',
            'kriteria' => DB::table('kriteria_saw')->select('*')->where('user_id', auth()->user()->id)->get()
        ];
        return view('metode_saw.kriteria.kriteria', $data);
    }
    public function crips_saw($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',
            'crips' => CripsSawModel::where('kriteria_id', $id)->where('user_id', auth()->user()->id)->get(),
            'kriteria' => DB::table('kriteria_saw')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_saw.kriteria.crips', $data);
    }
    public function tambah_crips($id)
    {

        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',

            'kriteria' => DB::table('kriteria_saw')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_saw.kriteria.tambah_crips', $data);
    }
    public function tambah_kriteria_crips(Request $request, $id)
    {
        CripsSawModel::create([
            'kriteria_id' => $request->id,
            'user_id' => auth()->user()->id,
            'nama_kriteria' => ucwords($request->nama_kriteria),
            'crips' => ucwords($request->crips),
            'nilai' => $request->nilai
        ]);
        return redirect('/metode/saw/crips/' . $id);
    }
    public function tambah_kriteria_saw()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',


        ];
        $q = DB::table('kriteria_saw')->select(DB::raw('MAX(RIGHT(kode_kriteria,1)) as kode'))->where('user_id', auth()->user()->id);
        $kd = "";
        if ($q->count() > 0) {

            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf('%01s', $tmp);
            }
        } else {
            $kd = "1";
        }
        return view('metode_saw.kriteria.tambah_kriteria', $data, compact('kd'));
    }
    public function tambah_kriteria(Request $request)
    {

        KriteriaModel::create([
            'kode_kriteria' => $request->kode_kriteria,
            'user_id' => auth()->user()->id,
            'nama_kriteria' => ucwords($request->nama_kriteria),
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot' => $request->bobot
        ]);
        return redirect('/metode/saw/kriteria/');
    }
    public function edit_kriteria($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',

            'kriteria' => DB::table('kriteria_saw')->select('*')->where('id', $id)->where('user_id', auth()->user()->id)->first()
        ];
        return view('metode_saw.kriteria.edit_kriteria', $data);
    }
    public function edit_kriteria_saw(Request $request, $id)
    {
        KriteriaModel::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot' => $request->bobot,
        ]);
        return redirect('metode/saw/kriteria');
    }
    public function edit_crips($id)
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Kriteria',
            'crips' => CripsSawModel::find($id),
            'kriteria' => DB::table('kriteria_saw')->select('*')->where('user_id', auth()->user()->id)->first()
        ];

        return view('metode_saw.kriteria.edit_crips', $data);
    }
    public function edit_crips_saw(Request $request, $id)
    {
        $kriteria = DB::table('kriteria_saw')->select('id')->first();
        CripsSawModel::where('id', $id)->where('user_id', auth()->user()->id)->update([
            'crips' => $request->crips,
            'nilai' => $request->nilai,
        ]);
        return redirect('/metode/saw/crips/' . $kriteria->id);
    }
}
