@extends('layouts.app')

@section('content')
    @livewire('pago-index', ['taquilla' => $taquilla])
@endsection
