<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'fecha_nacimiento',
    ];
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
    // Relación de uno a muchos con Contrato
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_empleado');
    }

}
