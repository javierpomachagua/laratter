@extends('layouts.app') 
@section('content')
<div class="jumbotron text-center">
    <h1>Laratter</h1>
    <nav>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li>
                <a class="nav-link" href="/about">Acerca de nosotros</a>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <form action="/messages/create" method="POST">
        <div class="form-group">
            @csrf
            <input type="text" name="message" class="form-control @if($errors->has('message'))
                is-invalid @endif" placeholder="Qué estás pensando?">
        </div>
        @if ($errors->has('message'))       
            @foreach ($errors->get('message') as $error)
                <p class="text-danger">{{ $error }}</p>                
            @endforeach
        @endif
    </form>
</div>
<div class="row">
    @forelse ($messages as $message)
    <div class="col-6">
        <img src="{{ $message->image }}" class="img-thumbnail">
        <p class="card-text">
            {{ $message['content'] }}
            <a href="/messages/{{ $message->id }}">Leer más</a>
        </p>
    </div>
    @empty
    <div class="alert-danger">
        No hay contenido
    </div>
    @endforelse
    
    @if (count($messages))
    <div class="mt-2 mx-auto">
        {{ $messages->links() }}
    </div>
    @endif

</div>
@endsection