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
        'id_cargo',
        'id_area',
        'id_local',
        'fecha_inicio',
        'fecha_fin',
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
    //Relación de uno a uno con Cargo
    public function cargo()
    {
        return $this->hasOne(Cargo::class, 'id_cargo');
    }
    //Relación de uno a uno con Area
    public function area()
    {
        return $this->hasOne(Area::class, 'id_area');
    }
    // Relación de uno a uno con Local
    public function local()
    {
        return $this->hasOne(Local::class, 'id_local');
    }
}
