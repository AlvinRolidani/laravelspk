<?php

namespace App\Models\metode_saw;

use App\Http\Controllers\metode_wp\KriteriaWPController;
use App\Models\metode_wp\KriteriaWPModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatifModel extends Model
{
    protected $table = 'nilai_alternatif_saw';
    protected $guarded = [];

    public function crips()
    {
        return $this->belongsTo(CripsSawModel::class, 'crips_id');
    }
    public function alternatif()
    {
        return $this->belongsTo(AlternatifSawModel::class, 'alternatif_id');
    }
}
