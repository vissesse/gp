<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classificacoe extends Model
{
    //
    protected $fillable = [
        'estudante_id',
        'curso_ano_academico_cadeira_id',
        'professor_id',
        'turma_id'
    ];

    public function estudante()
    {
        return $this->belongsTo('App\Model\Estudante');
    }

    public function nota()
    { 
        return $this->hasMany('App\Model\Nota');
    }

    public function professor()
    {
        return $this->belongsTo('App\Model\Professor');
    }

    public function cursoanoAcademico()
    {
        return $this->belongsTo('App\Model\CursoAnoAcademicoCadeira');
    }
}
