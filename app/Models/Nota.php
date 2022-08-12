<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //

    protected $fillable = [
        'tipo_avaliacao', 'nota', 'classificacoe_id'
    ];

    public function classificacao()
    {
        return $this->belongsTo('App\Models\Classificacoe');
    }

}
