<?php

namespace App\Http\Livewire;

use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $open = false;

    public $events = [];
    public $vacantes;

    public function mount()
    {
        if (Clase::latest()->first() != null) {
            $this->vacantes = Clase::latest()->first()->vacantes;
        }
        $this->vacantes = 10;
    }

    public function getMonitoresProperty()
    {
        return User::role('admin')->get();
    }

    public function eventReceive($event)
    {
        Clase::create([
            'monitor_id' => $event['extendedProps']['idmonitor'],
            'fecha_hora' => Carbon::createFromTimeString($event['start'])->subHour(),
            'vacantes' => $this->vacantes,
            'idevent' => $event['id'],
        ]);

        $this->emit("refreshCalendar");

        //$this->events[] = 'eventReceive: ' . print_r($event, true);
    }

    public function eventDrop($event, $oldEvent)
    {
        Clase::where('idevent', $oldEvent['id'])->update([
            'fecha_hora' => Carbon::createFromTimeString($event['start'])->subHour(),
        ]);

        //$this->events[] = 'eventDrop: ' . print_r($oldEvent, true) . ' -> ' . print_r($event, true);
    }

    public function eventClick($event)
    {
        $clase = Clase::where('idevent', $event['id'])->first();

        if ($clase->atletas->isEmpty()) {
            $clase->delete();
        } else {
            $this->open = true;
        }

        $this->emit("refreshCalendar");
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
