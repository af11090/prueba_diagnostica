<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contrato';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_empleado',
        'id_tipo_contrato',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    // Relación de uno a muchos con Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
    // Relación de uno a muchos con TipoContrato
    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'id_tipo_contrato');
    }
}
