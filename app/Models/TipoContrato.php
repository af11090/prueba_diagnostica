<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table = 'tipo_contratos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación de uno a muchos con Contrato
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_tipo_contrato');
    }
}
