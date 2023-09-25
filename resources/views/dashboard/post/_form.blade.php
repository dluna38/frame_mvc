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
@csrf
{{-- form:post --}}
{{-- Fila 1 --}}
<div class="row">
{{-- .row para crear una fila --}}
    <div class="form-group">
        <label for="name">Articulo</label><input class="form-control" type="text" name="name" id="name" value="{{old('name',$post->name)}}">
    </div>

    {{-- Fila 2 --}}
    <div class="row form-group">
        <label for="description">Contenido</label>
        <textarea class="form-control" name="description" id="description" rows="10" value="{{old('url_clean',$post->url_clean)}}"></textarea>
    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{old('description',$post->description)}}"> 
    </div>

    <input type="submit" value="Enviar" class="btn btn-primary">
</div>
@endsection