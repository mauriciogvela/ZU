<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{

	use SoftDeletes;
	protected $dates = ['fechaEliminacion'];
    protected $table = 'producto';

    const CREATED_AT = 'fechaIngreso';
    const UPDATED_AT = 'fechaActualizacion';
    const DELETED_AT = 'fechaEliminacion';


    protected $fillable = [
        'idProveedor', 'codigo', 'nombre', 'descripcion', 'precio', 'stock', 'visibleWeb', 'detalles', 'terminosCondiciones', 'idCategoria',
    ];

    public function categoria()
    {
        return $this->belongsTo('App\CategoriaProducto');
    }
    
}
