<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{

	use SoftDeletes;
	protected $dates = ['fechaEliminacion'];
    protected $table = 'servicios';

    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaActualizacion';
    const DELETED_AT = 'fechaEliminacion';


    protected $fillable = [
        'idProveedor', 'idCategoria', 'codigo', 'nombre', 'descripcion', 'existencia', 'capacidad', 'cantidadMinima', 'tiempoMinimo', 'precioUnitario', 'precioHora', 'visibilidad', 'detalles', 'terminosCondiciones', 'fechaAutorizacion'
    ];

    public function categoria()
    {
        return $this->belongsTo('App\CategoriaProducto');
    }
    
}
