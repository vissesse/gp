<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    //

    protected $fillable = [
        'nome',
        'email',
        'contacto',
        'Especialidade',
        'user_id'

    ];

    public function lecionaTurma()
    {
        return $this->hasMany('App\Model\Turma');
    }

    public function leciona()
    {
            return $this->hasMany('App\Model\ProfessorLecionaTurma');
    }
    public function classificacao()
    {
        return $this->hasMany('App\Model\Classificacao');
    }

    public function user()
    {
        return $this->is('App\User');
    }
}
