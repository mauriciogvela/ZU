<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class Usuarios extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request)
    {

        $user = new User();
        $user->nombre = $request->input('nombre');
        $user->apellidos = $request->input('apellidos');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');
        $user->puesto = $request->input('puesto');

        $user->password = bcrypt('@.'.$request->input('password').'.$');
        $user->token = 'token'; // pendiente de modificar
        $user->save();
        
        return response()->json($user->find($user->id));

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
