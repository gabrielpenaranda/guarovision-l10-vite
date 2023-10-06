@extends('layouts.front')


@section('content')
    @livewire('pago-web-form', ['cliente' => $cliente])
@endsection
