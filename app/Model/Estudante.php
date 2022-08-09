<?php

namespace App\Model;

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
        return $this->belongsTo('App\Model\Turma');
    }


    public function classificacao()
    {
        return $this->hasMany('App\Model\Classificacoe');
        # code...
    }

    public function cadeirasEspeciais()
    {
        return $this->hasMany('App\Model\CadeiraEspecial');
        # code...
    }

    public function user()
    {
        return $this->is('App\User');
    }
    //
}
