@extends('layouts.app')
@section('content')
<h1>{{ $user->name }}</h1>

@foreach ($user->messages as $message)
    <div class="col-lg-6">
        @include('messages.message')
    </div>    
@endforeach
@stop