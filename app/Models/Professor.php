<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Turma');
    }

    public function leciona()
    {
            return $this->hasMany('App\Models\ProfessorLecionaTurma');
    }
    public function classificacao()
    {
        return $this->hasMany('App\Models\Classificacao');
    }

    public function user()
    {
        return $this->is('App\Models\User');
    }
}
