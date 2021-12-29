@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/empleado/'.$data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}    
    @include('empleado.form',['mode'=>'Actualizar'])
</form>

</div>
@endsection