<?php

namespace App\Models\metode_topsis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CripsTOPSISModel extends Model
{
    use HasFactory;
    protected $table = 'crips_topsis';
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(AlternatifTOPSISModel::class, 'id');
    }
    public function kriteria()
    {
        return $this->belongsTo(KriteriaTOPSISModel::class, 'id');
    }
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifTOPSISModel::class, 'crips_id');
    }
}
