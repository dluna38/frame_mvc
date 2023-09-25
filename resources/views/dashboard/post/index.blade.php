@extends('dashboard.master')
@section('contenido')

<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripción</th>
        <th scope="col">Categoria</th>
        <th scope="col">Estado publicación</th>
        <th scope="col">Creación</th>
        <th scope="col">Actualización</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($posts as $post)
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->name}}</td>
        <td>{{$post->description}}</td>
        <td>{{$post->category_id}}</td>
        @if ($post->state == 'no_post')
            <td>No publicado</td>
        @else
            <td>Publicado</td>
        @endif
        <td>{{$post->created_at->format('d-m-Y')}}</td>
        <td>{{$post->updated_at->format('d-m-Y')}}</td>
        <td>
            <a href="{{ route('post.show',$post->id) }}" class="btn btn-primary">Ver</a>
            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-primary">Actualizar</a> 
            <button data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{ $post->id }}" class="btn btn-danger">Eliminar</button> 
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
{{$posts ->links()}}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content"> 
      <div class="modal-header"> 
        <h5 class="modal-title" id="modalLabel">Eliminar</h5>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <p>Seguro que desea borrar el registro seleccionado?</p>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> 
        <form id="formDelete" method="POST" action="{{ route('post.destroy',0) }}" data-action="{{ route('post.destroy',0) }}">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger">Borrar</button>
        </form> 
      </div> 
    </div> 
  </div> 
</div> 





<script>
window.onload = function(){
  const deleteModal = document.getElementById("deleteModal");
  const formDelete = document.getElementById("formDelete");
  
  deleteModal.addEventListener('shown.bs.modal', (event) => {
    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id');
    var action = formDelete.getAttribute('action').slice(0,-1)
    action += id
    formDelete.setAttribute("action", action);
    const modalTitle = deleteModal.querySelector('.modal-title')
    modalTitle.textContent = `Vas a borrar el POST: ${id}`
  })
}; 

</script>

@endsection