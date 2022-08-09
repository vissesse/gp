<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    protected $fillable = [
        'turma_id',
        'user_id',
        'processo',
        'nome'
    ];


    public function turma()
    {
        # code...
        return $this->belongsTo('App\Models\Turma');
    }


    public function classificacao()
    {
        return $this->hasMany('App\Models\Classificacoe');
        # code...
    }

    public function cadeirasEspeciais()
    {
        return $this->hasMany('App\Models\CadeiraEspecial');
        # code...
    }

    public function user()
    {
        return $this->is('App\Models\User');
    }
    //
}
