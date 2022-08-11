<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Estudante');
    }

    public function nota()
    { 
        return $this->hasMany('App\Models\Nota');
    }

    public function professor()
    {
        return $this->belongsTo('App\Models\Professor');
    }

    public function cursoanoAcademico()
    {
        return $this->belongsTo('App\Models\CursoAnoAcademicoCadeira');
    }
}
