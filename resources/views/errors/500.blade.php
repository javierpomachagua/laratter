@extends('layouts.app')

@section('content')
Hubo algún error
<h2>{{ $exception->getMessage() }}</h2>
@endsection