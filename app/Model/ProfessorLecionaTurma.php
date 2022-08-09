<?php

namespace App\Model;

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
        return $this->belongsTo('App\Model\Professor');
    }

    public function cadeira()
    {
        return $this->belongsTo('App\Model\Cadeira');
        # code...
    }

    public function turma()
    {
        return $this->belongsTo('App\Model\Turma');
        # code...
    }
    //
}
