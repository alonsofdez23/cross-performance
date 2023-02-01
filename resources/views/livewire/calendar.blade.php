<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-4 md:gap-6">

        <div>

            <div id='external-events'>
                <div class="mb-3">
                    <label for="default-input" class="block mb-2 font-semibold text-gray-700">Plazas disponibles</label>
                    <input wire:model="vacantes" type="number" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                </div>

                <div class="mb-3">
                    <label for="default-input" class="block mb-2 font-semibold text-gray-700">Entrenamiento</label>
                    <select wire:model="entreno" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                        <option selected value="vacio">Sin entrenamiento</option>
                        @foreach ($entrenos as $entreno)
                            <option value="{{ $entreno->id }}">{{ $entreno->denominacion }}</option>
                        @endforeach
                    </select>
                    {{-- <input wire:model="entreno" type="number" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"> --}}
                </div>

                <label for="default-input" class="block mb-2 font-semibold text-gray-700">Monitores</label>
                @foreach ($this->monitores as $monitor)
                    <div data-event='@json(['idmonitor' => $monitor->id, 'id' => uniqid(), 'title' => $monitor->name])' class='bg-gray-700 cursor-move my-0.5 p-1 px-3 fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                        <div class='fc-event-main'>{{ $monitor->name}}</div>
                    </div>
                @endforeach

                <ul>
                    @foreach (array_reverse($events) as $event)
                        <li>{{ $event }}</li>
                    @endforeach
                </ul>
            </div>

            <x-jet-dialog-modal wire:model="openOld">
                <x-slot name="title">
                    <div class="flex justify-center my-6">
                        <i class="fa-solid fa-triangle-exclamation fa-lg fa-beat"></i>
                    </div>
                    <div class="flex justify-center text-xl font-bold">
                        Esta clase ya finalizó
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-center">
                        No se pueden eliminar clases finalizadas
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('openOld', false)">
                        Aceptar
                    </x-jet-secondary-button>
                </x-slot>
            </x-jet-dialog-modal>

            @if ($openAtletas)
                @include('livewire.calendar-delete')
            @endif

        </div>

        <div class="mt-5 md:mt-0 md:col-span-3">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                <div id='calendar' wire:ignore></div>
            </div>
        </div>
    </div>
</div>

@push('cal')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
    document.addEventListener('livewire:load', function() {
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');

        // Inicializa eventos externos
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
        itemSelector: '.fc-event'
        });

        // Inicializa calendario
        // -----------------------------------------------------------------

        var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        weekNumbers: false, // Numero semana del año
        navLinks: true, // Puede hacer click en días de la semana
        dayMaxEvents: true, // Eventos tooltip

        locale: 'es',
        initialView: 'timeGridWeek',
        allDaySlot: false, // Ocultar visor todo el día
        slotMinTime: '8:00:00', // Hora inicio día
        slotMaxTime: '22:00:00', // Hora fin día
        height: 500,
        eventColor: '#2d3f50', // Color eventos en calendario
        dayHeaders: true,
        dayHeaderFormat: {
            weekday: 'short',
            day: 'numeric',
        },
        slotDuration: '00:30:00', // Intervalo al dropear evento

        editable: true,
        droppable: true, // Permite drag/drop en eventos

        eventReceive: info => @this.eventReceive(info.event),
        eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
        eventClick: info => @this.eventClick(info.event),

        loading: function(isLoading) {
                if (!isLoading) {
                    // Reset custom events
                    this.getEvents().forEach(function(e){
                        if (e.source === null) {
                            e.remove();
                        }
                    });
                }
            }
        });

        calendar.addEventSource( {
            url: '/admincalget',
            extraParams: function() {
                return {
                    name: @this.name
                };
            }
        });

        calendar.render();

        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents()
        });
    });

    </script>

    <style>
        /* Eventos draggables */
        .fc-h-event {
            border: 1px solid #2d3f50;
            border: 1px solid var(--fc-event-border-color, #2d3f50);
            background-color: #2d3f50;
            background-color: var(--fc-event-bg-color, #2d3f50)
        }
        /* Selector día actual */
        .fc-day-today {
            background: !important;
        }
    </style>
@endpush
