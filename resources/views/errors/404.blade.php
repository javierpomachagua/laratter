@extends('layouts.app')

@section('content')
No hemos podido encontrar lo que buscas
<h2>{{ $exception->getMessage() }}</h2>
@endsection