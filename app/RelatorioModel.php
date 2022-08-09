<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioModel extends Model
{
    //

    protected $fillable = [
        'professor_id',
        'turma_id',
        'cadeira_id',
        'curso',
        'semestre',
        'processo',
        'estudante',
        'p1',
        'p2',
        'ac',
        'media',
        'exame',
        'recurso',
        'exame_especial',
        'resultado_final',
        'observacao',
    ];

    public function cadeira()
    {
        return $this->belongsTo('App\Model\Cadeira');
    }
}
