<?php

namespace App\Http\Controllers\metode_topsis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\metode_topsis\KriteriaTOPSISModel;
use App\Models\metode_topsis\AlternatifTOPSISModel;

class TOPSISController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'TOPSIS',
            'menu' => 'Home',
            'kriteria' => KriteriaTOPSISModel::where('user_id', auth()->user()->id)->count(),
            'alternatif' => AlternatifTOPSISModel::where('user_id', auth()->user()->id)->count()

        ];
        return view('metode_topsis.index', $data);
    }
}
