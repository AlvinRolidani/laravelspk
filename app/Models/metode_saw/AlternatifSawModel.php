<?php

namespace App\Models\metode_saw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifSawModel extends Model
{
    use HasFactory;
    protected $table = 'alternatif_saw';

    protected $guarded = [];
    public function penilaian()
    {
        return $this->hasMany(NilaiAlternatifModel::class, 'alternatif_id');
    }
}
