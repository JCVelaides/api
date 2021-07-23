<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');
    }

    protected $fillable = [
        'nombreFinca',
        'procedencia',
        'departamento',
        'verificado',
        'fechaVerificado',
        'nombreVerificado',
        'observacionVerificado',
        'estado',
        'id_usuario'
    ];
}
