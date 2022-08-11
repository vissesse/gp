<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadeiraEspecial extends Model
{
    //

    protected $fillable = [
        'estufante_id',
        'curso_id',
        'cadeira_id'
    ];

    public function cursoAnoCademicoCadeira()
    {
        # code...
        return $this->belongsTo('App\Models\CursoAnoAcademicoCadeira');
    }

    public function estudante()
    {
        # code...
        return $this->belongsTo('App\Models\Estudante');
    }
}
