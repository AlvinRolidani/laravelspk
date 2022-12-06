<?php

namespace App\Models\metode_wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatifWPModel extends Model
{
    use HasFactory;
    protected $table = 'nilai_alternatif_wp';
    protected $guarded = [];

    public function crips()
    {
        return $this->belongsTo(CripsWPModel::class, 'crips_id');
    }
    public function alternatif()
    {
        return $this->belongsTo(AlternatifWPModel::class, 'alternatif_id');
    }
}
