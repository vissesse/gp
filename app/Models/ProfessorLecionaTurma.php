<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorLecionaTurma extends Model
{

    protected $fillable = [
        'professor_id',
        'turma_id',
        'cadeira_id'
    ];


    public function professor()
    {
        return $this->belongsTo('App\Models\Professor');
    }

    public function cadeira()
    {
        return $this->belongsTo('App\Models\Cadeira');
        # code...
    }

    public function turma()
    {
        return $this->belongsTo('App\Models\Turma');
        # code...
    }
    //
}
