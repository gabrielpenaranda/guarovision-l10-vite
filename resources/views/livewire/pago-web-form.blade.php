<div class="container mx-auto max-w-3xl">
    <h3 class="flex justify-center text-gray-900 text-xs sm:text-base lg:text-xl font-semibold mt-8">
        Registro de Pago
    </h3>
    {{-- <form action="{{ route('pago-web.procesa-pago', ['cliente' => $cliente->id]) }}" enctype="multipart/form-data"
        method="POST"> --}}
    @csrf

    <div class="mx-auto mt-4">

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="" class="form-label mb-2">
                    Monto pendiente US$
                </label>
            </div>
            <div class="text-left">
                <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mb-2">
                    @php
                        echo number_format($cuenta, 2, ',', '.');
                    @endphp
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="" class="form-label mb-2">
                    Tasa 1 US$-> Bs
                </label>
            </div>
            <div class="text-left">
                <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mb-2">
                    @php
                        echo number_format($divisa->tasa, 4, ',', '.');
                    @endphp
                </span>
            </div>
        </div>

        @php
            $total = $cuenta * $divisa->tasa;
        @endphp

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="" class="form-label mb-2">
                    Monto Total a Pagar Bs
                </label>
            </div>
            <div class="text-left">
                <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mb-2">
                    @php
                        echo number_format($total, 4, ',', '.');
                    @endphp
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Monto a pagar Bs.D.
                </label>
            </div>
            <div class="text-left">
                <input type="number" name="monto_bs" min="0.0001" max="{{ $cuenta }}" step="0.0001"
                    class="form-control mb-2" wire:model="monto" />
                <x-jet-input-error for="monto" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="text-right items-center">
                <label for="tipo" class="form-label mb-2">
                    Tipo de Pago
                </label>
            </div>
            <div class="text-left items-center">
                <select name="t_pago" id="t_pago" class="form-control mb-2" wire:model="t_pago">
                    <option value="pago_movil">Pago Móvil</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Realizado por <br>
                    <small>
                        Nombre y Apellido del titular de la cuenta <br>desde donde envía el pago
                    </small>
                </label>
            </div>
            <div class="text-left">
                <input type="text" name="realizado_por" class="form-control mb-2" placeholder="Titular de la cuenta"
                    wire:model="realizado_por" />
                <x-jet-input-error for="realizado_por" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Cédula <br>
                    <small>Cédula del titular de la cuenta</small>
                </label>
            </div>
            <div class="text-left">
                <input type="text" name="cedula" class="form-control mb-2" placeholder="Ej. 98765432 (sólo numeros)"
                    wire:model="cedula" />
                <x-jet-input-error for="cedula" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Teléfono celular <br>
                    <small>Número de celular del titular de la cuenta</small>
                </label>
            </div>
            <div class="text-left">
                <input type="text" name="telefono_celular" class="form-control mb-2" placeholder="Ej. 04249876543"
                    wire:model="telefono_celular" />
                <x-jet-input-error for="telefono_celular" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Número de Transferencia/Pago Móvil <br>
                    <small>Número que le dió el Banco cuando realizó <br> la transferencia ó pago móvil</small>
                </label>
            </div>
            <div class="text-left">
                <input type="text" name="num_referencia" class="form-control mb-2"
                    placeholder="Ej. 9786543210123456456" wire:model="num_referencia" />
                <x-jet-input-error for="num_referencia" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Banco de origen
                </label>
            </div>
            <div class="text-left">
                <select name="banco_origen_id" id="banco_origen_id" class="form-control mb-2"
                    wire:model="banco_origen_id">
                    <option value="">Escoja un banco</option>
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->banco }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="banco_origen_id" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Banco destino
                </label>
            </div>
            <div class="text-left">
                <select name="banco_destino_id" id="banco_destino_id" class="form-control mb-2"
                    wire:model="banco_destino_id">
                    <option value="">Escoja un banco</option>
                    @foreach ($bancos_d as $banco_d)
                        <option value="{{ $banco_d->id }}">{{ $banco_d->banco }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="banco_destino_id" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Imágen del pago
                </label>
            </div>
            <div class="text-left">
                <input type="file" name="imagen_pago" class="form-control mb-2 btn btn-sm" accept="image/*"
                    wire:model="imagen_pago" />
                <x-jet-input-error for="imagen_pago" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 items-center">
            <div class="text-right">
                <label for="tipo" class="form-label mb-2">
                    Observaciones
                </label>
            </div>
            <div class="text-left">
                <textarea name="observaciones" cols="28" rows="5"class="form-control mb-2" placeholder="Observaciones"
                    wire:model="observaciones"></textarea>
                <x-jet-input-error for="telefono_celular" />
            </div>
        </div>

        {{-- <div class="flex mt-4 justify-center">
            @if ($imagen_pago)
                <img src="{{ $imagen_pago->temporaryUrl() }}" width="" class="w-1/2">
            @endif
        </div> --}}

    </div>

    <div class="text-center mt-6">
        {{-- <button type="submit" class="btn btn-sm btn-verde mx-2">Procesar Pago</button> --}}
        <button wire:click="procesar_pago()" wire:loading.attr="disabled" wire:target="imagen_pago"
            class="btn btn-sm btn-verde mx-2">Procesar Pago</button>
    </div>
    {{-- </form> --}}
    <div class="text-right">
        <a href="{{ route('pago-web.index') }}"
            class="mr-8 sm:mr-20 text-xs sm:text-sm md:text-base underline text-red-600 font-semibold">
            Regresar
        </a>
    </div>
</div>
