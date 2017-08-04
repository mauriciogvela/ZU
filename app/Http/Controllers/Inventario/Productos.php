<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Producto;
use App\Models\CategoriaProducto;

use Image;

class Productos extends Controller
{
    protected $user; //obtener id del usuario de la base de datos dependiendo del usuario logueado
    protected $producto;
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = 1;
        $this->producto = new Producto();
    }
    public function index(){
        $user = new User();
        $categorias = new CategoriaProducto();
        $categorias = $categorias->all();
        $user = $user->find($this->user);

        return view('productos.index', [
            'user' => $user, 
            'categorias' => $categorias,
        ]);
    }
    public function productosProveedor(Request $request)
    {
        
        $categoria = new CategoriaProducto();

        $idCategoria = $request->input('idCategoria');
        $busqueda = $request->input('busqueda');

        $productos = $this->producto
                        ->where('idProveedor', $this->user)
                        ->when($idCategoria, function ($query) use ($idCategoria) {
                            return $query->where('idCategoria', $idCategoria);
                        })
                        ->when($busqueda, function ($query) use ($busqueda) {
                            return $query->where(function($query) use ($busqueda){
                                $query->where('nombre', 'like', '%'.$busqueda.'%');
                                $query->orWhere('codigo', 'like', '%' . $busqueda . '%');
                                $query->orWhere('descripcion', 'like', '%' . $busqueda . '%');
                            });
                        })
                        ->orderBy('fechaActualizacion', 'DESC');

        $productos = $productos->get();

        foreach($productos as $key => $producto){
            $categoria = $categoria->find($producto->idCategoria);
            $productos[$key]->categoria = $categoria->nombre;
        }
        return view('productos.tabla', ['productos' => $productos]);
    }

    public function add($id='')
    {
        $user = new User();
        $categorias = new CategoriaProducto();

        $user = $user->find($this->user);
        $categorias = $categorias->all();
        $datos = ['categorias' => $categorias, 'user' => $user, 'producto' => $this->producto, 'imagenes' => []];
        if($id){
            $producto = $this->producto->where('idProveedor',$this->user)->find($id);
            $producto->visibleWeb=($producto->visibleWeb==1)?'checked':'';
            $datos['producto'] = $producto;
            $disco = Storage::disk('image');
            $datos['imagenes'] = $disco->allFiles('productos/' . $this->user . '/' . $id . '/thumbnail');
        }
        return view('productos.agregar', $datos);
    }
    public function create(Request $request)
    {
        $validacion = \Validator::make(
            $request->all(), 
            [
                'codigo' => 'required|alpha_num|max:45',
                'nombre' => 'required:digits_between:1,255',
                'descripcion' => 'required',
                'precioUnitario' => 'required|numeric',
                'cantidadMinima' => 'required|numeric',
                'capacidad' => 'required|numeric',
                'existencia' => 'required|numeric',
                'visibilidad' => 'required|boolean',
                'idCategoria' => 'required|numeric|digits_between:1,11',
                'detalles' => 'required',
                'terminosCondiciones' => 'required',
            ]
        );
        if ($validacion->fails()) {
            return response()->json($validacion->errors());
        }else if($request->input('id')){
            //faltan validaciones sobre la actualizacion del producto
            // * ¿Se podra modificar si existe en algun pedido existente?
            $this->producto = $this->producto->where('idProveedor', $this->user)->find($request->input('id'));
            $msj='Producto editado';
        }else{
            $this->producto->idProveedor = $this->user;
            $msj='Producto agregado';
        }
        $producto = $this->producto->fill($request->all());
        //guardado del producto
        $producto->save();
        // creacion de la carpeta del usuario en caso de no existir
        if(is_array($request->input('imagenes'))){
            $disco = Storage::disk('image');
            $disco->makeDirectory('productos/' . $this->user . '/' . $producto->id);
            foreach ($request->input('imagenes') as $k => $image) {
                $path_move='productos/' . $this->user . '/' . $producto->id;
                $disco->move('temp/' . $image, $path_move . '/original/' . $image);
                $disco->move('temp/thumbnail_' . $image, $path_move . '/thumbnail/' . $image);
                $disco->move('temp/resize_' . $image, $path_move . '/resize/' . $image);
            }
        }
        return response()->json(['Exito'=>true, 'Msj' => $msj, 'Campos'=>array_keys($request->all())]);
    }

    public function delete(Request $request)
    {
        //faltan validaciones sobre la eliminacion del producto
        // *Que no exista en algun pedido existente
        $eliminado = $this->producto->where('idProveedor', $this->user)
                        ->where('id', $request->input('id'))
                        ->delete();
        if($eliminado){
            return response()->json(['Exito'=>true,  'Msj' => 'Producto eliminado']);
        }else{
            return response()->json(['Error' => 'No se elimino el producto']);
        }
    }

    public function uploadImage(Request $request)
    {
        $validacion = \Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',//5mb
        ]);
        if ($validacion->fails()) {
            return response()->json($validacion->errors());
        }else{
            $image = $request->file('image');
            $nameImage = time() . '.' . $image->getClientOriginalExtension();
         
            $destinationPath = public_path('img/temp');
            $img = Image::make($image->getRealPath());
            $img->resize(128, 96, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/thumbnail_'.$nameImage);

            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/resize_'.$nameImage);

            $image->move($destinationPath, $nameImage);

            return response()->json(['Exito' => true, 'Thumbnail'=>asset('img/temp/thumbnail_'.$nameImage), 'Nombre' => $nameImage, 'Msj' => 'Imagen cargada']);
        }

    }

    public function deleteImage(Request $request)
    {   
        $producto = $request->input('producto');
        $imagen = $request->input('imagen');
        $disco = Storage::disk('image');
        $path =  'temp';
        //eliminado de temporales
        $disco->delete($path . '/' . $imagen);
        $disco->delete($path . '/thumbnail_' . $imagen);
        $disco->delete($path . '/resize_' . $imagen);
        if(!is_null($producto)){
            //Si ya se habia guardado se elimina de la carpeta del producto
            $path =  'productos/'.$this->user.'/'.$producto ;
            $disco->delete($path . '/original/' . $imagen);
            $disco->delete($path . '/thumbnail/' . $imagen);
            $disco->delete($path . '/resize/' . $imagen);
        }
        
        return response()->json(['Exito' => true, 'Msj' => 'Imagen eliminada']);
    }

    public function show($id)
    {
        $producto = $this->producto->where('idProveedor', $this->user)->find($id);
        return response()->json($producto);
    }

    public function find($campos, $valores)
    {
        $producto = $this->producto->find($id);
        return response()->json($producto);    
    }
    
}