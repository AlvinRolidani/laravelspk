<?php

namespace App\Models\metode_saw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CripsSawModel extends Model
{
    use HasFactory;
    protected $table = 'crips_saw';
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(AlternatifSawModel::class, 'id');
    }
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'id');
    }
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifModel::class, 'crips_id');
    }
}
