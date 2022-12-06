<?php

namespace App\Models\metode_wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifWPModel extends Model
{
    use HasFactory;
    protected $table = 'alternatif_wp';

    protected $guarded = [];
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifWPModel::class, 'alternatif_id');
    }
}
