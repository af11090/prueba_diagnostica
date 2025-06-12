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
        return $this->belongsToMany(Area::class, 'local_area', 'id_local', 'id_area');
    }
    //Relación de uno a uno con Contrato
    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id_local');
    }

}
