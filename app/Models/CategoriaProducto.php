<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{

    protected $table = 'cat_categorias';
    
    public function productos()
    {
        return $this->hasMany('App\Producto');
    }

}
