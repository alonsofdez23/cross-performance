<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">
                <form wire:submit.prevent="submit">

                    <div>
                        <x-jet-label for="dia" value="Día" />
                        <input wire:model.lazy="dia" type="text"
                        id="date"
                        class="text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-300 w-full py-2"
                        required
                        readonly/>
                    </div>

                    <div>
                        <x-jet-label for="hora_inicio" value="Hora de apertura" />
                        <x-jet-input wire:model="horaInicio" id="hora_inicio" type="text" placeholder="8:00" class="mt-1 block w-full" />
                        <x-jet-input-error for="hora_inicio" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="hora_fin" value="Hora de cierre" />
                        <x-jet-input wire:model="horaFin" id="hora_fin" type="text" placeholder="15:00" class="mt-1 block w-full" />
                        <x-jet-input-error for="hora_fin" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="duracion" value="Duración de clases (minutos)" />
                        <x-jet-input wire:model="duracion" id="duracion" type="number" placeholder="60" class="mt-1 block w-full" />
                        <x-jet-input-error for="duracion" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="vacantes" value="Plazas disponibles" />
                        <x-jet-input wire:model="vacantes" id="vacantes" type="number" placeholder="10" class="mt-1 block w-full" />
                        <x-jet-input-error for="vacantes" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="monitor" value="Monitor" />
                        <select wire:model="monitor" name="monitor" id="monitor" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Selecciona monitor</option>
                            @foreach ($monitores as $monitor)
                                <option value="{{ $monitor->id }}">{{ $monitor->name }}</option>
                            @endforeach
                        </select>
                        {{-- <x-select
                            placeholder="Selecciona monitor"
                            wire:model.defer="monitor"
                            >
                            @foreach ($monitores as $monitor)
                                <x-select.user-option src="{{ $monitor->profile_photo_url }}" label="{{ $monitor->name }}" value="{{ $monitor->id }}" />
                            @endforeach
                        </x-select> --}}
                    </div>

            </div>
        </div>
    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-jet-button>
                            Guardar
                        </x-jet-button>
                    </div>
                </form>

</div>

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
