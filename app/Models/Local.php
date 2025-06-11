<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'direccion',
    ];

    // Relación de muchos a muchos con áreas
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_local', 'id_local', 'id_area');
    }

}
