<?php

namespace App\Models\metode_wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CripsWPModel extends Model
{
    use HasFactory;
    protected $table = 'crips_wp';
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(AlternatifWPModel::class, 'id');
    }
    public function kriteria()
    {
        return $this->belongsTo(KriteriaWPModel::class, 'id');
    }
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifWPModel::class, 'crips_id');
    }
}
