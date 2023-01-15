    <x-app-layout>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @livewire('calendar')

        </div>
    </div>
    @push('calo')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },

                    weekNumbers: false, // Numero semana del año
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    dayMaxEvents: true, // allow "more" link when too many events

                    locale: 'es',
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '22:00:00',
                    events: @json($events),
                    height: 500,

                    selectable: true, // Seleccionable
                    selectMirror: true, // Dibuja evento mientras selecciona

                    dateClick: function(info) {
                        $('#clase').modal('show');
                    }
                    /* select: function (start, end, allDay) {
                        $("#clase").modal('toggle');
                        if (monitor) {
                            var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                            var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');

                            $.ajax({
                                url: "{{ URL::to('crearclase') }}",
                                data: 'monitor=' + monitor + '&start=' + start + '&end=' + end + '&_token=' + "{{ csrf_token() }}",
                                type: "post",
                                success: function (data) {
                                    alert("Añadido correctamente");
                                }
                            })
                        }
                    } */
                });
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
