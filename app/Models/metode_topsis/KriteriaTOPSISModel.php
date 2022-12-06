<?php

namespace App\Models\metode_topsis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaTOPSISModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria_topsis';
    protected $guarded = [];

    public function crips()
    {
        return $this->hasMany(CripsTOPSISModel::class, 'kriteria_id');
    }
}
