@extends('dash.main')

@section('content')
    {{ ( isset($message) ) ? $message : 'Tela indisponível no momento' }}
@endsection