<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación de muchos a muchos con áreas
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_cargo', 'id_cargo', 'id_area');
    }
}
