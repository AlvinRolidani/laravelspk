<?php

namespace App\Models\metode_wp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaWPModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria_wp';
    protected $guarded = [];

    public function crips()
    {
        return $this->hasMany(CripsWPModel::class, 'kriteria_id');
    }
}
