@extends('layouts.app')
@section('content')
<h1>{{ $user->name }}</h1>
<a href="/{{ $user->username }}/follows">
    Sigue a <span class="badge badge-default">{{ $user->follows->count() }}</span>
</a>

<a href="/{{ $user->username }}/followers">
    Seguidores <span class="badge badge-default">{{ $user->followers->count() }}</span>
</a>

@if (Auth::check())
    @if (Auth::user()->isFollowing($user))
    <form action="/{{ $user->username }}/unfollow" method="POST">
        @csrf
        <button class="btn btn-danger">Dejar de seguir</button>
        @if(session('success'))
        <span class="text-success">
            {{ session('success') }}
        </span>
        @endif
    </form>    
    @else
    <form action="/{{ $user->username }}/follow" method="POST">
        @csrf
        <button class="btn btn-primary">Seguir</button>
        @if(session('success'))
        <span class="text-success">
            {{ session('success') }}
        </span>
        @endif
    </form>    
    @endif
@endif


@foreach ($user->messages as $message)
    <div class="col-lg-6">
        @include('messages.message')
    </div>    
@endforeach
@stop