<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    //Relaciones de muchos a muchos con cargos y locales
    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'area_cargo', 'id_area', 'id_cargo');
    }
    public function locales()
    {
        return $this->belongsToMany(Local::class, 'area_local', 'id_area', 'id_local');
    }
    // Relación de uno a uno con Contrato
    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id_area');
    }
}
