@extends('layouts.app')

@section('content')
    @livewire('pago-taquilla-lista', ['taquilla_id' => $taquilla_id, 'inicio' => $inicio, 'final' => $final])
@endsection
