<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //

    protected $fillable = ['curso_id', 'nome', 'ano_academico'];

    public function estudante()
    {
        return $this->hasMany("App\Model\Estudante");
        # code...
    }

    public function curso()
    {
        return $this->belongsTo('App\Model\Curso');
        # code...
    }

    public function professorLecionaTurma()
    {
        return $this->hasMany('App\Model\ProfessorLecionaTurma');
        # code...
    }
}
