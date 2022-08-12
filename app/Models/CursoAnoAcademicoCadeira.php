<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoAnoAcademicoCadeira extends Model
{
    //

    protected $fillable = [
        'curso_id', 'cadeira_id', 'ano_academico', 'semestre'

    ];

    public function cadeira()
    {
        return $this->belongsTo('App\Models\Cadeira');
    }


    public function curso()
    {

        return $this->belongsTo('App\Models\Curso');
        # code...
    }

    public function classificacoes()
    {
        # code...
        return $this->hasMany('App\Models\Classificacoe');
    }
}
