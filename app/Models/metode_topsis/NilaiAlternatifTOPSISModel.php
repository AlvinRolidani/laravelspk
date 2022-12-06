<?php

namespace App\Models\metode_topsis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatifTOPSISModel extends Model
{
    use HasFactory;
    protected $table = 'nilai_alternatif_topsis';
    protected $guarded = [];

    public function crips()
    {
        return $this->belongsTo(CripsTOPSISModel::class, 'crips_id');
    }
    public function alternatif()
    {
        return $this->belongsTo(AlternatifTOPSISModel::class, 'alternatif_id');
    }
}
