<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{

    protected $table = 'categoriaproducto';
    
    public function productos()
    {
        return $this->hasMany('App\Producto');
    }

}
