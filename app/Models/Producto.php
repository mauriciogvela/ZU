<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{

	use SoftDeletes;
	protected $dates = ['fechaEliminacion'];
    protected $table = 'productos';

    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = 'fechaActualizacion';
    const DELETED_AT = 'fechaEliminacion';


    protected $fillable = [
        'idProveedor', 'idCategoria', 'codigo', 'nombre', 'descripcion', 'existencia', 'capacidad', 'cantidadMinima', 'precioUnitario', 'visibilidad', 'detalles', 'terminosCondiciones', 'fechaAutorizacion'
    ];

    public function categoria()
    {
        return $this->belongsTo('App\CategoriaProducto');
    }
    
}
