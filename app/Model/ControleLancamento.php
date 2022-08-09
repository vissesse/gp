<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ControleLancamento extends Model
{
    //

    protected $fillable = [
        'tipo_avaliacao_id',
        'data_inicio',
        'data_fim'
    ];

    public function tipoAvaliacao()
    {
        return $this->belongsTo('App\Model\TipoAvaliacao');
    }
}
