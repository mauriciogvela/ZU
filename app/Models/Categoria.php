<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'cat_categorias';
    
    public function productos()
    {
        return $this->hasMany('App\Producto');
    }
    public function servicios()
    {
        return $this->hasMany('App\Servicio');
    }

}
