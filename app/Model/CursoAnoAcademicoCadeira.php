<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CursoAnoAcademicoCadeira extends Model
{
    //

    protected $fillable = [
        'curso_id', 'cadeira_id', 'ano_academico', 'semestre'

    ];

    public function cadeira()
    {
        return $this->belongsTo('App\Model\Cadeira');
    }


    public function curso()
    {

        return $this->belongsTo('App\Model\Curso');
        # code...
    }

    public function classificacoes()
    {
        # code...
        return $this->hasMany('App\Model\Classificacoe');
    }
}
