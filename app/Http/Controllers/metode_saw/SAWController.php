<?php

namespace App\Http\Controllers\metode_saw;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;
use App\Models\metode_saw\KriteriaModel;
use Illuminate\Database\Schema\Blueprint;
use App\Models\metode_saw\AlternatifSawModel;


class SAWController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'SAW',
            'menu' => 'Home',
            'nilai_alternatif' => DB::table('nilai_alternatif_saw')->select('*')->where('user_id', auth()->user()->id)->get(),
            'kriteria' => KriteriaModel::where('user_id', auth()->user()->id)->count(),
            'alternatif' => AlternatifSawModel::where('user_id', auth()->user()->id)->count()
        ];


        return view('metode_saw.index', $data);
    }
}
