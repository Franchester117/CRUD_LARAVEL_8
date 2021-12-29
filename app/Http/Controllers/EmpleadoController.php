<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(5);

        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos = [
            "nombres"=>"required|string|max:100",
            "apellidos"=>"required|string|max:100",
            "correo"=>"required|email",
            "foto"=>"required|max:50000000|mimes:jpg,png,jpeg"
        ];

        $mensajes=[
            "required"=>"El :attribute es requerido",
            "foto.required"=>"La foto es requerida"
        ];


        $this->validate($request,$campos,$mensajes);

        $datos = request()->except('_token');

        if(request()->hasFile('foto')){
            $datos['foto'] = request()
                             ->file('foto')
                             ->store('upload','public');
        }

        Empleado::insert($datos);
        return redirect('empleado/')->with('mensaje','Empleado agregado');
        //return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Empleado::findOrFail($id);
        return view('empleado.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
            "nombres"=>"required|string|max:100",
            "apellidos"=>"required|string|max:100",
            "correo"=>"required|email"            
        ];

        $mensajes=[
            "required"=>"El :attribute es requerido"            
        ];

        if(request()->hasFile('foto')){
            $campos = ["foto"=>"required|max:50000000|mimes:jpg,png,jpeg"];
            $mensajes = ["foto.required"=>"La foto es requerida"];
        }

        $this->validate($request,$campos,$mensajes);

        $datos = request()->except(['_token','_method']);
        
        if(request()->hasFile('foto')){
            $data = Empleado::findOrFail($id);
            Storage::delete('public/'.$data->foto);
            $datos['foto'] = request()->
                            file('foto')->
                            store('upload','public');
        }

        empleado::where('id','=',$id)->update($datos);
        $data = Empleado::findOrFail($id);
        //return view('empleado.edit',compact('data'));
        return redirect('empleado/')->with('mensaje','Empleado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Empleado::findOrFail($id);
        
        if(Storage::delete('public/'.$img->foto)){
            Empleado::destroy($id);                       
        }

        return redirect('empleado/')->with('mensaje','Empleado eliminado');
        
    }
}
