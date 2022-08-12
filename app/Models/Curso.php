<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Turma');
        # code...
    }

    public function tipoAvaliacao()
    {
        return $this->hasMany('App\Models\TipoAvaliacao');
        # code...
    }

    public function cursoAnoAcademicoCadeira()
    {
        return $this->hasMany('App\Models\Curso');
    }
}
