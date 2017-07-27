<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Producto;
use App\CategoriaProducto;

class Inventario extends Controller
{
    protected $user; //obtener id del usuario de la base de datos dependiendo del usuario logueado
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = 1;
    }
    public function index(){
    	$user = new User();
    	$categorias = new CategoriaProducto();
    	$categorias = $categorias->all();
    	$user = $user->find($this->user);

    	return view('inventario.index', ['user' => $user, 'categorias' => $categorias]);
    }

}