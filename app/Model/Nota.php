<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //

    protected $fillable = [
        'tipo_avaliacao', 'nota', 'classificacoe_id'
    ];

    public function classificacao()
    {
        return $this->belongsTo('App\Model\Classificacoe');
    }

}
