<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoAvaliacao extends Model
{
    //

    protected $fillable = [
        'curso_id',
        'nome'
    ];

    public function classificacao()
    {
        return $this->hasMany('App\Model\Classificao');
        # code...
    }

    public function controleLancamento()
    {
        return $this->hasMany('App\Model\ControleLancamento');
        # code...
    }
    public function curso()
    {
        return $this->belongsTo('App\Model\Curso');
        # code...
    }
}
