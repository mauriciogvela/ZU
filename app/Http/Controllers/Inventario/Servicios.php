<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Categoria;

use Image;

class Servicios extends Controller
{
    protected $user; //obtener id del usuario de la base de datos dependiendo del usuario logueado
    protected $servicio;
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = 1;
        $this->servicio = new Servicio();
    }
    public function index(){
        $user = new User();
        $categorias = new Categoria();
        $categorias = $categorias->all();
        $user = $user->find($this->user);

        return view('servicios.index', [
            'user' => $user, 
            'categorias' => $categorias,
        ]);
    }
    public function consultarServicios(Request $request)
    {
        
        $categoria = new Categoria();

        $idCategoria = $request->input('idCategoria');
        $busqueda = $request->input('busqueda');

        $servicios = $this->servicio
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

        $servicios = $servicios->get();

        foreach($servicios as $key => $servicio){
            $categoria = $categoria->find($servicio->idCategoria);
            $servicios[$key]->categoria = $categoria->nombre;
        }
        return view('servicios.tabla', ['servicios' => $servicios]);
    }

    public function add($id='')
    {
        $user = new User();
        $categorias = new Categoria();

        $user = $user->find($this->user);
        $categorias = $categorias->all();
        $datos = ['categorias' => $categorias, 'user' => $user, 'servicio' => $this->servicio, 'imagenes' => []];
        if($id){
            $servicio = $this->servicio->where('idProveedor',$this->user)->find($id);
            $servicio->visibleWeb=($servicio->visibleWeb==1)?'checked':'';
            $datos['servicio'] = $servicio;
            $disco = Storage::disk('image');
            $datos['imagenes'] = $disco->allFiles('servicios/' . $this->user . '/' . $id . '/thumbnail');
        }
        return view('servicios.agregar', $datos);
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
            //faltan validaciones sobre la actualizacion del servicio
            // * ¿Se podra modificar si existe en algun pedido existente?
            $this->servicio = $this->servicio->where('idProveedor', $this->user)->find($request->input('id'));
            $msj='Servicio editado';
        }else{
            $this->servicio->idProveedor = $this->user;
            $msj='Servicio agregado';
        }
        $servicio = $this->servicio->fill($request->all());
        //guardado del servicio
        $servicio->save();
        // creacion de la carpeta del usuario en caso de no existir
        if(is_array($request->input('imagenes'))){
            $disco = Storage::disk('image');
            $disco->makeDirectory('servicios/' . $this->user . '/' . $servicio->id);
            foreach ($request->input('imagenes') as $k => $image) {
                $path_move='servicios/' . $this->user . '/' . $servicio->id;
                $disco->move('temp/' . $image, $path_move . '/original/' . $image);
                $disco->move('temp/thumbnail_' . $image, $path_move . '/thumbnail/' . $image);
                $disco->move('temp/resize_' . $image, $path_move . '/resize/' . $image);
            }
        }
        return response()->json(['Exito'=>true, 'Msj' => $msj, 'Campos'=>array_keys($request->all())]);
    }

    public function delete(Request $request)
    {
        //faltan validaciones sobre la eliminacion del servicio
        // *Que no exista en algun pedido existente
        $eliminado = $this->servicio->where('idProveedor', $this->user)
                        ->where('id', $request->input('id'))
                        ->delete();
        if($eliminado){
            return response()->json(['Exito'=>true,  'Msj' => 'Servicio eliminado']);
        }else{
            return response()->json(['Error' => 'No se elimino el servicio']);
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
        $servicio = $request->input('servicio');
        $imagen = $request->input('imagen');
        $disco = Storage::disk('image');
        $path =  'temp';
        //eliminado de temporales
        $disco->delete($path . '/' . $imagen);
        $disco->delete($path . '/thumbnail_' . $imagen);
        $disco->delete($path . '/resize_' . $imagen);
        if(!is_null($servicio)){
            //Si ya se habia guardado se elimina de la carpeta del servicio
            $path =  'servicios/'.$this->user.'/'.$servicio ;
            $disco->delete($path . '/original/' . $imagen);
            $disco->delete($path . '/thumbnail/' . $imagen);
            $disco->delete($path . '/resize/' . $imagen);
        }
        
        return response()->json(['Exito' => true, 'Msj' => 'Imagen eliminada']);
    }

    public function show($id)
    {
        $servicio = $this->servicio->where('idProveedor', $this->user)->find($id);
        return response()->json($servicio);
    }

    public function find($campos, $valores)
    {
        $servicio = $this->servicio->find($id);
        return response()->json($servicio);    
    }
    
}