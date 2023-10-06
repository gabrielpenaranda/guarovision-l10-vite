@extends('layouts.app')

@section('content')
    @livewire('pago-web-lista', ['inicio' => $inicio, 'final' => $final]);
@endsection
