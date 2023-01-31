<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

            <!-- Variable Session -->
            @if (session()->has('success'))
                <div class="grid lg:grid-cols-3">
                    <div class="lg:col-start-2">
                        <div class="text-center bg-green-100 p-4 mb-4 text-sm text-green-700 rounded-lg" role="alert">
                            <span class="font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="lg:col-start-2">
                        <div class="text-center bg-red-100 p-4 mb-4 text-sm text-red-700 rounded-lg" role="alert">
                            <span class="font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 xl:gap-x-8">
                <!-- Selector de días -->
                <div class="flex justify-between">
                    <div>
                        <button wire:click="dayBack" class="inline-flex items-center mr-4 px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-200 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex">
                        <input wire:model.lazy="pickDay" type="text"
                        id="date"
                        class="mr-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2"
                        required
                        readonly/>
                        <button wire:click="currentDay" class="inline-flex items-center mr-4 px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-200 rounded-md">
                            Hoy
                        </button>
                    </div>
                    <div>
                        <button wire:click="dayForward" class="inline-flex items-center ml-4 px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-200 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Clase vacía -->
                @if ($clases->isEmpty())
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            <span class="block">Día de descanso.</span>
                            <a class="block text-gray-400">Tómate un respiro.</span>
                        </h2>
                    </div>
                @endif

                <!-- Lista de clases -->
                <ol class="relative border-l border-gray-500">

                    @foreach ($clases as $clase)
                        <li class="mb-10 ml-6">
                            <span class="flex absolute -left-4 justify-center items-center w-8 h-8 bg-gray-200 rounded-full ring-8 ring-white">
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>
                            <h3 class="flex items-center ml-2 mb-1 text-xl font-semibold text-gray-900">{{ $clase->fecha_hora->tz('Europe/Madrid')->format('G.i') }}
                            <div class="flex-shrink-0 ml-3">
                                <img wire:click="showMonitor({{$clase}})" class="w-10 h-10 rounded-md cursor-pointer" src="{{ $clase->monitor->profile_photo_url }}" alt="{{ $clase->monitor->name }}">
                            </div>

                                <!-- Plazas disponibles -->
                                @if (!$clase->vacantes == 0)
                                    <button type="button" class="cursor-default inline-flex items-center ml-4 px-3 py-2 text-sm font-medium text-center text-green-800 bg-green-200 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>

                                        <span class="inline-flex justify-center items-center ml-2 w-5 h-5 text-base font-semibold text-green-200 bg-green-800 rounded-md">
                                        {{ $clase->vacantes }}
                                        </span>
                                    </button>
                                @else
                                    <button type="button" class="cursor-default inline-flex items-center ml-4 px-3 py-2 text-sm font-medium text-center text-red-800 bg-red-200 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>

                                        <span class="inline-flex justify-center items-center ml-2 w-5 h-5 text-base font-semibold text-red-200 bg-red-800 rounded-md">
                                        {{ $clase->vacantes }}
                                        </span>
                                    </button>
                                @endif

                                <!-- Entrenamiento -->
                                @if ($clase->entreno != null)
                                <button wire:click="showEntreno({{$clase}})" type="button" class="inline-flex items-center ml-4 px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-200 rounded-md">
                                    {{ $clase->entreno->denominacion }}
                                </button>
                                @endif

                                @hasanyrole('admin|coach')
                                @if ($clase->entreno_id == null)
                                    <form wire:submit.prevent="addEntreno({{ $clase->id }})" class="flex">
                                        <div class="ml-4">
                                            <select wire:model="entrenoJoin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500">
                                                <option hidden selected>Selecciona entreno</option>
                                                @foreach ($entrenos as $entreno)
                                                    <option value="{{ $entreno->id }}">{{ $entreno->denominacion }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="inline-flex items-center ml-2 py-2 px-4 text-sm font-medium text-gray-900 bg-gray-200 rounded-md border border-gray-200 hover:bg-gray-200 hover:text-gray-700">
                                            <svg aria-hidden="true" class="w-5 h-5 fill-current text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <button wire:click="deleteEntreno({{$clase}})" type="submit" class="inline-flex items-center ml-2 py-2 px-3 text-sm font-medium text-gray-900 bg-red-200 rounded-md border border-gray-200 hover:bg-red-200 hover:text-gray-700">
                                        <svg aria-hidden="true" class="w-5 h-5 fill-current text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                        </svg>
                                    </button>
                                @endif
                                @endhasanyrole

                            </h3>

                            <!-- Lista de atletas en clase -->
                            <div class="mt-6 grid grid-cols-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                                @foreach ($clase->atletas as $atleta)
                                    <div class="flex -space-x-4 -space-y-2">
                                        <img wire:click="showUser({{$atleta}})" class="rounded-2xl cursor-pointer" src="{{ $atleta->profile_photo_url }}" alt="{{ $atleta->name }}">
                                        @hasanyrole('admin|coach')
                                            <button wire:click="delete({{ $atleta }}, {{ $clase }})" type="submit" class="w-5 h-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#fecaca" viewBox="0 0 24 24" stroke-width="1.5" stroke="#991b1b" class="w-7 h-7 hover:fill-red-300">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        @endhasanyrole
                                    </div>
                                @endforeach
                                @for ($i = 0; $i < $clase->vacantes; $i++)
                                    <div><img class="rounded-2xl" src="https://ui-avatars.com/api/?background=bbf7d0&color=bbf7d0&size=512" alt="libre"></div>
                                @endfor
                            </div>
                        </li>

                        <!-- Join/leave de clase -->
                        <div class="flex ml-6 mb-6 pb-4 rounded-md" role="group">
                            @if (!$clase->atletas->contains(Auth::user()) && $clase->vacantes != 0 && $clase->fecha_hora > now())
                                    <button wire:click="join({{ $clase->id }})" type="submit" class="inline-flex items-center py-2 px-4 text-base font-medium text-gray-900 bg-green-200 rounded-md border border-gray-200 hover:bg-green-300 hover:text-gray-700">
                                        <svg aria-hidden="true" class="w-5 h-5 text-green-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                        </svg>
                                    </button>
                            @elseif ($clase->atletas->contains(Auth::user()) && $clase->fecha_hora > now())
                                    <button wire:click="leave({{ $clase->id }})" type="submit" class="inline-flex items-center py-2 px-4 text-base font-medium text-gray-900 bg-red-200 rounded-md border border-gray-200 hover:bg-red-300 hover:text-gray-700">
                                        <svg aria-hidden="true" class="w-5 h-5 text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                        </svg>
                                    </button>
                            @else
                                <button type="button" class="inline-flex items-center cursor-not-allowed py-2 px-4 text-base font-medium text-gray-900 bg-red-100 rounded-md border border-gray-200 hover:bg-red-200 hover:text-gray-700">
                                    <svg aria-hidden="true" class="w-5 h-5 text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </button>
                            @endif

                            <!-- Select atleta a clase -->
                            @if ($clase->vacantes != 0)
                                @hasanyrole('admin|coach')
                                    <form wire:submit.prevent="submit({{ $clase->id }})" class="flex">
                                        <div class="flex mx-3">
                                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500"
                                                placeholder="Selecciona atleta" wire:model="atleta">
                                                <option hidden selected>Selecciona atleta</option>
                                                @foreach ($users->diff($clase->atletas) as $atleta)
                                                    <option src="{{ $atleta->profile_photo_url }}" label="{{ $atleta->name }}" value="{{ $atleta->id }}" />
                                                @endforeach
                                            </select>

                                            {{-- <x-select
                                                placeholder="Selecciona atleta"
                                                wire:model="atleta"
                                                >
                                                @foreach ($users->diff($clase->atletas) as $atleta)
                                                    <x-select.user-option src="{{ $atleta->profile_photo_url }}" label="{{ $atleta->name }}" value="{{ $atleta->id }}" />
                                                @endforeach
                                            </x-select> --}}

                                            <button type="submit" class="ml-2 inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 bg-gray-200 rounded-md border border-gray-200 hover:bg-gray-300 hover:text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </div>

                                    </form>
                                @endhasanyrole
                            @endif

                        </div>
                    @endforeach
                </ol>

            </div>



        </div>

    </div>
</div>

<x-jet-dialog-modal wire:model="openUser">

    <x-slot name="title">
    </x-slot>

    <x-slot name="content">

        <div class="flex flex-col items-center">
            <img class="w-24 h-24 mb-3 rounded-2xl shadow-lg" src="{{ $this->avatar }}" alt="{{ $this->name }}"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $this->name }}</h5>
            @hasanyrole('admin|coach')
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $this->email }}</span>
            @endhasanyrole
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$set('openUser', false)">
            Cerrar
        </x-jet-button>
    </x-slot>

</x-jet-dialog-modal>

<x-jet-dialog-modal wire:model="openEntreno">

    <x-slot name="title">
        <div class="flex justify-center text-xl font-bold">
            {{ $this->denominacion }}
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="px-6">
            {!! $this->entreno !!}
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$set('openEntreno', false)">
            Cerrar
        </x-jet-button>
    </x-slot>

</x-jet-dialog-modal>


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    new Pikaday({
        field: document.getElementById('date'),
        format: 'DD/MM/YYYY',
        firstDay: 1,
        keyboardInput: false,
        i18n: {
            previousMonth : 'Anterior',
            nextMonth     : 'Siguiente',
            months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            weekdays      : ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            weekdaysShort : ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb']
        },
        onSelect: function(date) {
            field.value = this.getMoment().format('YYYY-MM-DD');
        }
    })
</script>
@endsection

@section('select2')
    <script>
        document.addEventListener('livewire:load', function(){
            $('.select2').select2({
                placeholder: 'Selecciona entreno',
            });
        })
    </script>
@endsection
