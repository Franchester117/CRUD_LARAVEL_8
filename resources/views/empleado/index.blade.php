@extends('layouts.app')

@section('content')
<div class="container">

<a class="btn btn-success" href="{{ url('empleado/create') }}">Crear nuevo empleado</a>
<br><br>

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('mensaje')}}        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>         
@endif


<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $empleados as $d )
            <tr>
                <td>{{ $d->id }}</td>
                <td><img src="{{ asset('storage').'/'.$d->foto }}" 
                         alt="Imagen del empleado"
                         height="100px"
                         width="100px"
                         class="img-thumbnail img-fluid"></td>
                <td>{{ $d->nombres }}</td>
                <td>{{ $d->apellidos }}</td>
                <td>{{ $d->correo }}</td>
                <td class="">
                    <a class="btn btn-warning" href="{{ url('/empleado/'.$d->id.'/edit') }}">Editar</a>

                    <form action="{{  url('/empleado/'.$d->id)  }}" method="post" class="d-inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres eliminarlo?')"
                               value="Eliminar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection
