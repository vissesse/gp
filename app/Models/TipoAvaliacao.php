<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Classificao');
        # code...
    }

    public function controleLancamento()
    {
        return $this->hasMany('App\Models\ControleLancamento');
        # code...
    }
    public function curso()
    {
        return $this->belongsTo('App\Models\Curso');
        # code...
    }
}
