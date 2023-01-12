<div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-4 md:gap-6">
            {{-- <x-jet-section-title>
                <x-slot name="title">Horario</x-slot>
                <x-slot name="description">Definir horarios para clases</x-slot> --}}

            <div>

                <div id='external-events'>
                    <p>
                        <strong>Draggable Events</strong>
                    </p>

                    <select wire:model="name" id="selectName">
                        <option value="">Elige monitor</option>
                        @foreach ($this->names as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>

                    @foreach ($this->tasks as $task)
                        <div  data-event='@json(['id' => uniqid(), 'title' => $task])' class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                            <div class='fc-event-main'>{{ $task}}</div>
                        </div>
                    @endforeach

                    <p>
                        <input type='checkbox' id='drop-remove' />
                        <label for='drop-remove'>remove after drop</label>
                    </p>

                    <ul>
                        @foreach (array_reverse($events) as $event)
                            <li>{{ $event }}</li>
                        @endforeach
                    </ul>
                </div>

            {{-- </x-jet-section-title> --}}
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

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
        itemSelector: '.fc-event'
        });

        // initialize the calendar
        // -----------------------------------------------------------------

        var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        weekNumbers: false, // Numero semana del año
        navLinks: true, // can click day/week names to navigate views
        dayMaxEvents: true, // allow "more" link when too many events

        locale: 'es',
        initialView: 'timeGridWeek',
        slotMinTime: '8:00:00',
        slotMaxTime: '22:00:00',
        height: 500,

        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventReceive: info => @this.eventReceive(info.event),
        eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
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
            url: '/calendar/events',
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

    /* #external-events {
        z-index: 2;
        top: 20px;
        left: 20px;
        width: 150px;
        padding: 0 10px;
    } */

    #external-events .fc-event {
        cursor: move;
        margin: 3px 0;
    }

    </style>
@endpush
