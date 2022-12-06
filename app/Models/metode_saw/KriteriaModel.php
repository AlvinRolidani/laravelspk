<?php

namespace App\Models\metode_saw;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria_saw';
    protected $guarded = [];

    public function crips()
    {
        return $this->hasMany(CripsSawModel::class, 'kriteria_id');
    }
}
