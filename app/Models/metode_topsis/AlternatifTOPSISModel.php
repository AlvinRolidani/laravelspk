<?php

namespace App\Models\metode_topsis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifTOPSISModel extends Model
{
    use HasFactory;
    protected $table = 'alternatif_topsis';

    protected $guarded = [];
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifTOPSISModel::class, 'alternatif_id');
    }
}
