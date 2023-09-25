{{-- Llamamos la vista de la cual heredaremos la estructura --}}
{{-- @extends: indica el nombre de la vista padre, desde donde la vista actual
hereda la estructura. --}}
@extends('dashboard.master') 
{{-- @section: hace referencia al nombre asignado a la directiva
@yield en la vista padre. --}}
@section('contenido')
{{-- @include: incluye la vista que contiene la validación de los campos de los
formularios. --}}
@include('dashboard.partials.validation-error')

<form action="{{ route('post.store')}}" method="post">
    @csrf
    {{-- form:post --}}
    {{-- Fila 1 --}}
    <div class="row">
    {{-- .row para crear una fila --}}
        <div class="form-group">
            <label for="name">Articulo</label>
            <input readonly class="form-control" type="text" name="name" id="name" value="{{$post->name}}">
        </div>

        <div class="form-group">
            <label for="url_clean">Url limpia</label>
            <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{$post->url_clean}}"> 
        </div>

        {{-- Fila 2 --}}
        <div class="row form-group">
            <label for="description">Contenido</label>
            <textarea readonly class="form-control" name="description" id="description" rows="10" value="{{$post->description}}"></textarea>
        </div>

        {{-- Fila 3 --}}
        <div class="row center">
        {{-- Las columnas en bootstrap tienen un ancho de 12
        Añadir 2 input en una fila: 12/cantidadInput--}}
        <div class="col s6">
            <button class="btn btn-success btn-sm" type="submit">Publicar</button>
            <button class="btn btn-danger btn-sm">Cancelar</button>
        </div>
    </div>
</form>
@endsection