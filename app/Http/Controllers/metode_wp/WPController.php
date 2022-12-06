<?php

namespace App\Http\Controllers\metode_wp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\metode_wp\KriteriaWPModel;
use App\Models\metode_wp\AlternatifWPModel;

class WPController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Metode SPK',
            'sub_title' => 'WP',
            'menu' => 'Home',
            'kriteria' => KriteriaWPModel::where('user_id', auth()->user()->id)->count(),
            'alternatif' => AlternatifWPModel::where('user_id', auth()->user()->id)->count()

        ];
        return view('metode_wp.index', $data);
    }
}
