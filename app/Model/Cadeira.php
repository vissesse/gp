<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cadeira extends Model
{
    //

    protected $fillable = [
        'nome',
    ];

    public function professorLecionaTurma()
    {
        return $this->belongsTo('App\Model\ProfessorLecionaTurma');
    }

    public function anoCademicoCadeira()
    {
        # code...
        return $this->hasMany('App\Model\CursoAnoAcademicoCadeira');
    }
}
