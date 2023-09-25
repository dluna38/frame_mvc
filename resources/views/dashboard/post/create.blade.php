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

<form action="{{ route("post.store") }}" method="POST" >
    @include( 'dashboard.post._form') ) 
</form> 
@endsection