

<h2>{{ $mode }} empleado</h2>



@if(  count($errors)>0  )

    <div class="alert alert-warning alert-dismissible fade show" role="alert">        
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>                
    </div>

@endif


<div class="form-group">
    <label for="nombres">Nombres</label>
    <input type="text" class="form-control" name="nombres" id="nombres"
           value="{{ isset($data->nombres)?$data->nombres:old('nombres') }}"> 
</div>

<div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input type="text" class="form-control" name="apellidos" id="apellidos"
           value="{{ isset($data->apellidos)?$data->apellidos:old('apellidos') }}"> 
</div>

<div class="form-group">
    <label for="correo">Correo</label>
    <input type="text" class="form-control" name="correo" id="correo"
           value="{{ isset($data->correo)?$data->correo:old('correo') }}"> 
</div>

<div class="form-group">
    <label for="foto"></label>

    @if(  isset($data->foto)  )
    <img src="{{ asset('storage').'/'.$data->foto }}"
        height="100px" width="100px"
        alt="Imagen del empleado"
        class="img-thumbnail img-fluid">
    @endif
    <input type="file" class="form-control" name="foto" id="foto"> 

</div>
<br>
<input type="submit" class="btn btn-success" value=" {{ $mode }} empleado">
<a class="btn btn-seccondary" href="{{ url('empleado/') }}">Regresar</a>

