<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //

    protected $fillable = [
        'nome',
        'anos_academicos'
    ];

    public function turmas()
    {
        return $this->hasMany('App\Model\Turma');
        # code...
    }

    public function tipoAvaliacao()
    {
        return $this->hasMany('App\Model\TipoAvaliacao');
        # code...
    }

    public function cursoAnoAcademicoCadeira()
    {
        return $this->hasMany('App\Model\Curso');
    }
}
