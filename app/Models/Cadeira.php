<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadeira extends Model
{
    //

    protected $fillable = [
        'nome',
    ];

    public function professorLecionaTurma()
    {
        return $this->belongsTo('App\Models\ProfessorLecionaTurma');
    }

    public function anoCademicoCadeira()
    {
        # code...
        return $this->hasMany('App\Models\CursoAnoAcademicoCadeira');
    }
}
