@if(session('status'))
<div class="alert alert-primary">
    {{ session('status') }}
</div>
@endif