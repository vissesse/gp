<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //

    protected $fillable = ['curso_id', 'nome', 'ano_academico'];

    public function estudante()
    {
        return $this->hasMany("App\Models\Estudante");
        # code...
    }

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso');
        # code...
    }

    public function professorLecionaTurma()
    {
        return $this->hasMany('App\Models\ProfessorLecionaTurma');
        # code...
    }
}
