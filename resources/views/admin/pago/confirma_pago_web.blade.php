@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-4 max-w-5xl">

        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Confirmación de Pagos Web</h4>

        </div>
        {{-- <x-table> --}}
        <form action="{{ route('pago.confirma-procesa') }}" method="POST">
            @csrf
            <div class="bg-white pb-4 rounded-xl border-4">
                <div class="grid grid-cols-6 mt-4 gap-2">
                    <div class="text-xs font-bold text-center">
                        Número
                    </div>
                    <div class="text-xs font-bold text-center">
                        Fecha
                    </div>
                    <div class="text-xs font-bold text-center">
                        Conciliado
                    </div>
                    <div class="text-xs font-bold text-center">
                        Cliente
                    </div>
                    <div class="text-xs font-bold text-center">
                        Tipo
                    </div>
                    <div class="text-xs font-bold text-center">
                        Monto
                    </div>
                </div>
                <div class="mt-4 mx-4">
                    @php
                        $acum = 0;
                    @endphp
                    @foreach ($pago_webs as $pago_web)
                        <div class="grid grid-cols-6 mt-4 gap-2">

                            <div class="text-center">
                                <label class="text-xs">
                                    <input type="checkbox" name="pago_web_id[]" class="form-control"
                                        value="{{ $pago_web->id }}" />
                                    {{ $pago_web->pago_web }}
                                </label>
                            </div>


                            <div class="text-center">
                                <span class="text-xs">
                                    @php
                                        echo date_format($pago_web->created_at, 'd/m/Y');
                                    @endphp
                                </span>
                            </div>

                            <div class="text-center">
                                @if ($pago_web->conciliado == true)
                                    <i class="fa-solid fa-check text-xs text-verde-700"></i>
                                @else
                                    <i class="fa-solid fa-xmark text-xs text-red-700"></i>
                                @endif
                            </div>

                            <div class="text-left">
                                <span class="text-xs text-left">
                                    {{ $pago_web->cliente->nombres }} {{ $pago_web->cliente->apellidos }}
                                </span>
                            </div>

                            <div class="text-center">
                                <span class="text-xs">
                                    @if ($pago_web->tipo_pago == 'M')
                                        Pago Móvil
                                    @else
                                        Transferencia
                                    @endif
                                </span>
                            </div>

                            <div class="text-right">
                                <span class="text-xs">
                                    @php
                                        echo number_format($pago_web->monto, 2, ',', '.');
                                    @endphp
                                </span>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 mx-4 text-right">
                @can('pago.confirma')
                    <button type="submit" class="btn btn-sm btn-verde">Confirmar Pagos</button>
                @endcan
            </div>
        </form>
        {{-- </x-table> --}}
    </div>
@endsection
