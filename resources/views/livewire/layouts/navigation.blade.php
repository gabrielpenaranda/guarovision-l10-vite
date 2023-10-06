<nav class="bg-white border-b-2 border-azul-900 sticky top-0 " x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

            <!-- Mobile menu button-->
            <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                <button x-on:click="open = true" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                        Icon when menu is closed.

                        Heroicon name: outline/menu

                        Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!--
                        Icon when menu is open.

                        Heroicon name: outline/x

                        Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Logotipo y Menu LG --}}
            <div class="flex-1 flex items-center justify-center md:items-stretch md:justify-start">

                {{-- logotipo --}}
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="block lg:hidden h-8 w-auto" src="{{ asset('images/logo-205x63.png') }}"
                            alt="Workflow">
                    </a>
                    <a href="{{ route('dashboard') }}">
                        <img class="hidden lg:block h-14 w-auto" src="{{ asset('images/logo-205x63.png') }}"
                            alt="Workflow">
                    </a>
                </div>

                {{-- menu LG --}}
                <div class="hidden md:block md:ml-6">
                    <div class="flex space-x-4">

                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        {{-- Sistema --}}
                        @if (auth()->user()->can('usuario.index') ||
                            auth()->user()->can('log.index'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Sistema</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="origin-top-left absolute left-0 mt-6 w-48 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @can('usuario.index')
                                            <a href="{{ route('usuario.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="sistemas-menu-item-0">
                                                Usuarios
                                            </a>
                                        @endcan
                                        @can('log.index')
                                            <a href="{{ route('log.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="sistemas-menu-item-1">
                                                Log
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Ubicacion --}}
                        @if (auth()->user()->can('estado.index') ||
                            auth()->user()->can('ciudad.index') ||
                            auth()->user()->can('zona.index') ||
                            auth()->user()->can('taquilla.index'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Ubicación</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="origin-top-left absolute left-0 mt-6 w-48 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @can('estado.index')
                                            <a href="{{ route('estado.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="ubicacion-menu-item-0">
                                                Estados
                                            </a>
                                        @endcan

                                        @can('ciudad.index')
                                            <a href="{{ route('ciudad.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="ubicacion-menu-item-1">
                                                Ciudades
                                            </a>
                                        @endcan

                                        @can('zona.index')
                                            <a href="{{ route('zona.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="ubicacion-menu-item-2">
                                                Zonas
                                            </a>
                                        @endcan

                                        @can('taquilla.index')
                                            <a href="{{ route('taquilla.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="ubicacion-menu-item-3">
                                                Taquillas
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Finanza --}}
                        @if (auth()->user()->can('plan.index') ||
                            auth()->user()->can('concepto.index') ||
                            auth()->user()->can('divisa.index') ||
                            auth()->user()->can('tasa-cambio.index') ||
                            auth()->user()->can('banco.index') ||
                            auth()->user()->can('impuesto.index'))
                            <div x-data="{ op1: false }" class="mt-4 z-50">
                                <a x-on:click="op1 = true" href="#"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="z-50 bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Finanza</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        class="origin-top-left absolute left-0 mt-6 w-48 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @can('plan.index')
                                            <a href="{{ route('plan.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Planes
                                            </a>
                                        @endcan
                                        @can('concepto.index')
                                            <a href="{{ route('concepto.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Conceptos
                                            </a>
                                        @endcan
                                        {{-- @can('impuesto.index')
                                            <a href="{{ route('impuesto.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Impuestos
                                            </a>
                                        @endcan --}}
                                        @can('divisa.index')
                                            <a href="{{ route('divisa.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Divisas
                                            </a>
                                        @endcan
                                        @can('banco.index')
                                            <a href="{{ route('banco.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-3">
                                                Bancos
                                            </a>
                                        @endcan

                                        @can('movimiento-banco.index')
                                            <a href="{{ route('movimiento-banco.index') }}"
                                                class="z-50 block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-5">
                                                Movimiento Bancario
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Equipos --}}
                        @if (auth()->user()->can('marca-equipo.index') ||
                            auth()->user()->can('modelo-equipo.index') ||
                            auth()->user()->can('tipo-equipo.index') ||
                            auth()->user()->can('equipo.index'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Equipos</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        class="origin-top-left absolute left-0 mt-6 w-48 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @can('equipo.index')
                                            <a href="{{ route('equipo.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Equipos
                                            </a>
                                        @endcan
                                        @can('tipo-equipo.index')
                                            <a href="{{ route('tipo-equipo.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Tipos de Equipo
                                            </a>
                                        @endcan
                                        @can('marca-equipo.index')
                                            <a href="{{ route('marca-equipo.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-3">
                                                Marcas
                                            </a>
                                        @endcan
                                        @can('modelo-equipo.index')
                                            <a href="{{ route('modelo-equipo.index') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-5">
                                                Modelos
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Clientes --}}
                        @can('cliente.index')
                            <div class="mt-4">
                                <a href="{{ route('cliente.index') }}"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium">Clientes</a>
                            </div>
                        @endcan

                        {{-- Pagos --}}
                        @if (auth()->user()->can('pago.taquilla') ||
                            auth()->user()->can('pago.index'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Pagos</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        class="origin-top-left absolute left-0 mt-6 w-60 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @can('pago.index')
                                            <a href="{{ route('pago.selecciona-taquilla') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Taquilla
                                            </a>
                                        @endcan
                                        @can('pagos-taquilla.taquilla')
                                            <a href="{{ route('pagos-taquilla.taquilla') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Pagos por Taquilla
                                            </a>
                                        @endcan
                                        @can('pagos-web.web')
                                            <a href="{{ route('pagos-web.web') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Pagos Web
                                            </a>
                                        @endcan
                                        @can('pago.concilia')
                                            <a href="{{ route('pago.concilia') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Conciliar Pagos Web
                                            </a>
                                        @endcan
                                        @can('pago.confirma')
                                            <a href="{{ route('pago.confirma') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Confirmar Pagos Web
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Consumos --}}
                        @if (auth()->user()->can('recibo.genera') ||
                            auth()->user()->can('recibo.index') ||
                            auth()->user()->can('recibo.recibo') ||
                            auth()->user()->can('recibo.exonera'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Consumos</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        class="origin-top-left absolute left-0 mt-6 w-60 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @if (!auth()->user()->otro)
                                            @can('recibo.index')
                                                <a href="{{ route('recibo.index') }}"
                                                    class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                    Consumos
                                                </a>
                                            @endcan
                                            @can('recibo.index')
                                                <a href="{{ route('recibo.recibo-cliente') }}"
                                                    class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                    Registrar/Exonerar Consumo
                                                </a>
                                            @endcan
                                        @endif
                                        @can('recibo.genera')
                                            <a href="{{ route('recibo.genera') }}"
                                                class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Generar Consumo Mensual
                                            </a>
                                        @endcan
                                        {{-- @can('recibo.exonera')
                                            <a href="{{ route('recibo.exonera') }}" class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                Exonerar Consumos
                                            </a>
                                        @endcan --}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Reportes --}}
                        @if (auth()->user()->can('reporte.pago-general') ||
                            auth()->user()->can('reporte.recibo-general'))
                            <div x-data="{ op1: false }" class="mt-4">
                                <a x-on:click="op1 = true" href="#"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="bg-white hover:bg-gris hover:text-white focus:text-white focus:bg-gris text-grey-800 px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page">Reportes</a>

                                {{-- Dropdown menu configuración --}}
                                <div class="ml-3 relative">
                                    <div x-show="op1" x-cloak x-on:click.away="op1 = false"
                                        class="origin-top-left absolute left-0 mt-6 w-60 rounded-md shadow-lg py-1 bg-white ring-2 ring-azul-900 ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @if (!auth()->user()->otro)
                                            @can('reporte.pago-general')
                                                <a href="{{ route('reporte.pago-general') }}"
                                                    class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                    General de Pagos por Fecha
                                                </a>
                                            @endcan
                                            @can('reporte.recibo-general')
                                                <a href="{{ route('reporte.recibo-general') }}"
                                                    class="block px-2 py-2 mx-2 my-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md"
                                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                                    Consumos por Fecha
                                                </a>
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- boton notificacion --}}
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                {{-- <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    </button> --}}

                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    <div class="flex-col inline-flex items-center justify-between">
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex text-sm" id="user-menu-button" aria-expanded="false"
                                aria-haspopup="true">
                                <i class="text-sm fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                        </form> --}}
                        <a href="{{ route('salir') }}">
                            <i class="text-sm fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                        <span class="hidden lg:block ml-4 px-4 py-2 text-xs text-gray-700">
                            {{ auth()->user()->name }}
                        </span>
                    </div>
                </div>
                {{-- <div class="ml-3 relative" x-data="{ open: false }">
                    <div>
                        <div class="flex-col inline-flex items-center justify-between">
                            <button x-on:click="open = true" type="button" class="flex text-sm" id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                                <i class="text-xs lg:text-sm fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                            <span class="hidden lg:block ml-4 px-4 py-2 text-xs text-gray-700">
                                {{ auth()->user()->name }}
                            </span>
                        </div>

                        <div x-show="open" x-cloak x-on:click.away="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-64 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <span
                                    class="ml-4 block px-4 py-2 text-xs sm:text-sm text-gray-700">{{ auth()->user()->name }}</span>
                                <button type="submit"
                                    class="ml-4 block px-4 py-2 text-sm text-gray-700 hover:text-white hover:bg-gris rounded-md"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    Salir
                                </button>
                            </form>
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu" x-show="open" :class="{ block: open, hidden: !open }" x-cloak
            x-on:click.away="open = false">
            {{-- Sistema --}}
            @if (auth()->user()->can('usuario.index') ||
                auth()->user()->can('log.index'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3">
                        Sistema
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div x-show="op1" x-on:click.away="op1 = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" :class="{ block: open, hidden: !open }"
                        class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                        tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        @can('usuario.index')
                            <a href="{{ route('usuario.index') }}" class="block px-2 py-1" role="menuitem"
                                tabindex="-1" id="sistemas-menu-item-0">
                                <span
                                    class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                    Usuarios
                                </span>
                            </a>
                        @endcan
                        @can('log.index')
                            <a href="{{ route('log.index') }}" class="block px-2 py-1" role="menuitem" tabindex="-1"
                                id="sistemas-menu-item-1">
                                <span
                                    class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                    Log
                                </span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endif

            {{-- Ubicacion --}}
            @if (auth()->user()->can('estado.index') ||
                auth()->user()->can('ciudad.index') ||
                auth()->user()->can('zona.index') ||
                auth()->user()->can('taquilla.index'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Ubicación
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('estado.index')
                                <a href="{{ route('estado.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="ubicacion-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Estados
                                    </span>
                                </a>
                            @endcan

                            @can('ciudad.index')
                                <a href="{{ route('ciudad.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="ubicacion-menu-item-1">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Ciudades
                                    </span>
                                </a>
                            @endcan

                            @can('zona.index')
                                <a href="{{ route('zona.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="ubicacion-menu-item-2">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Zonas
                                    </span>
                                </a>
                            @endcan

                            @can('taquilla.index')
                                <a href="{{ route('taquilla.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="ubicacion-menu-item-3">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Taquillas
                                    </span>
                                </a>
                            @endcan
                            {{-- <a href="#" class="block px-2 py-1" role="menuitem" tabindex="-1" id="sistemas-menu-item-3">
                    <hr>
                </a> --}}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Finanza --}}
            @if (auth()->user()->can('plan.index') ||
                auth()->user()->can('concepto.index') ||
                auth()->user()->can('divisa.index') ||
                auth()->user()->can('tasa-cambio.index') ||
                auth()->user()->can('banco.index') ||
                auth()->user()->can('impuesto.index'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Finanza
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('plan.index')
                                <a href="{{ route('plan.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Planes
                                    </span>
                                </a>
                            @endcan
                            @can('concepto.index')
                                <a href="{{ route('concepto.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Conceptos
                                    </span>
                                </a>
                            @endcan
                            {{-- @can('impuesto.index')
                                <a href="{{ route('impuesto.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Impuestos
                                    </span>
                                </a>
                            @endcan --}}
                            @can('divisa.index')
                                <a href="{{ route('divisa.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Divisas
                                    </span>
                                </a>
                            @endcan
                            @can('banco.index')
                                <a href="{{ route('banco.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-3">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Bancos
                                    </span>
                                </a>
                            @endcan
                            @can('impuesto.index')
                                <a href="{{ route('impuesto.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-5">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Impuestos
                                    </span>
                                </a>
                            @endcan
                            @can('movimiento-banco.index')
                                <a href="{{ route('movimiento-banco.index') }}" class="block px-2 py-1"
                                    role="menuitem" tabindex="-1" id="finanza-menu-item-5">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Movimiento Bancario
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endif

            {{-- Equipos --}}
            @if (auth()->user()->can('marca-equipo.index') ||
                auth()->user()->can('modelo-equipo.index') ||
                auth()->user()->can('tipo-equipo.index') ||
                auth()->user()->can('equipo.index'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Equipos
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('equipo.index')
                                <a href="{{ route('equipo.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Equipos
                                    </span>
                                </a>
                            @endcan
                            @can('tipo-equipo.index')
                                <a href="{{ route('tipo-equipo.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Tipos de Equipo
                                    </span>
                                </a>
                            @endcan
                            @can('marca-equipo.index')
                                <a href="{{ route('marca-equipo.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-3">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Marcas
                                    </span>
                                </a>
                            @endcan
                            @can('modelo-equipo.index')
                                <a href="{{ route('modelo-equipo.index') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-5">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Modelos
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endif

            {{-- Clientes --}}
            @can('cliente.index')
                <div class="ml-3 relative">
                    <a href="{{ route('cliente.index') }}"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3">
                        Clientes
                    </a>
                </div>
            @endcan

            {{-- Pagos --}}
            @if (auth()->user()->can('pago.taquilla') ||
                auth()->user()->can('pago.index'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Pagos
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('pago.index')
                                <a href="{{ route('pago.selecciona-taquilla') }}" class="block px-2 py-1"
                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Taquilla
                                    </span>
                                </a>
                            @endcan
                            @can('pagos-taquilla.taquilla')
                                <a href="{{ route('pagos-taquilla.taquilla') }}" class="block px-2 py-1"
                                    role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Pagos por Taquilla
                                    </span>
                                </a>
                            @endcan
                            @can('pagos-web.web')
                                <a href="{{ route('pagos-web.web') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Pagos Web
                                    </span>
                                </a>
                            @endcan
                            @can('pago.concilia')
                                <a href="{{ route('pago.concilia') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Conciliar Pagos Web
                                    </span>
                                </a>
                            @endcan
                            @can('pago.confirma')
                                <a href="{{ route('pago.confirma') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Confirmar Pagos Web
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endif

            {{-- Consumos --}}
            @if (auth()->user()->can('recibo.genera') ||
                auth()->user()->can('recibo.index') ||
                auth()->user()->can('recibo.recibo') ||
                auth()->user()->can('recibo.exonera'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Consumos
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @if (!auth()->user()->otro)
                                @can('recibo.index')
                                    <a href="{{ route('recibo.index') }}" class="block px-2 py-1" role="menuitem"
                                        tabindex="-1" id="finanza-menu-item-0">
                                        <span
                                            class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                            Consumos
                                        </span>
                                    </a>
                                @endcan
                                @can('recibo.index')
                                    <a href="{{ route('recibo.recibo-cliente') }}" class="block px-2 py-1"
                                        role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                        <span
                                            class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                            Registrar/Exonerar Consumos
                                        </span>
                                    </a>
                                @endcan
                            @endif
                            @can('recibo.genera')
                                <a href="{{ route('recibo.genera') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Generar Consumo Mensual
                                    </span>
                                </a>
                            @endcan
                            {{-- @can('recibo.exonera')
                                <a href="{{ route('recibo.exonera') }}" class="block px-2 py-1" role="menuitem"
                                    tabindex="-1" id="finanza-menu-item-0">
                                    <span
                                        class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                        Exonerar Consumos
                                    </span>
                                </a>
                            @endcan --}}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Reportes --}}
            @if (auth()->user()->can('reporte.pago-general') ||
                auth()->user()->can('reporte.recibo-general'))
                <div x-data="{ op1: false }" class="ml-3 relative">
                    <a x-on:click="op1 = true" href="#"
                        class="hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris block px-2 py-2 rounded-md text-sm font-medium mr-3"
                        aria-current="page">
                        Reportes
                    </a>

                    {{-- Dropdown menu configuración --}}
                    <div class="ml-3 relative">
                        <div x-show="op1" x-on:click.away="op1 = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            :class="{ block: open, hidden: !open }"
                            class="hidden origin-top-right relative right-0 mt-0 w-full rounded-md py-1 ring-1 ring-gris ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @if (!auth()->user()->otro)
                                @can('reporte.pago-general')
                                    <a href="{{ route('reporte.pago-general') }}" class="block px-2 py-1" role="menuitem"
                                        tabindex="-1" id="finanza-menu-item-0">
                                        <span
                                            class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                            General de Pagos por Fecha
                                        </span>
                                    </a>
                                @endcan
                                @can('reporte.recibo-general')
                                    <a href="{{ route('reporte.recibo-general') }}" class="block px-2 py-1"
                                        role="menuitem" tabindex="-1" id="finanza-menu-item-0">
                                        <span
                                            class=" px-4 py-2 text-sm hover:font-semibold text-gray-800 hover:bg-gris hover:text-white focus:text-white focus:bg-gris rounded-md">
                                            Consumos por Fecha
                                        </span>
                                    </a>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
</nav>
