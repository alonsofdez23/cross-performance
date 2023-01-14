<?php

namespace App\Http\Livewire;

use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $name = 'admin';
    public $events = [];
    public $vacantes;

    public function mount()
    {
        if (Clase::latest()->first() != null) {
            $this->vacantes = Clase::latest()->first()->vacantes;
        }
        $this->vacantes = 1;
    }

    public function updatedName()
    {
        $this->emit("refreshCalendar");
    }

    public function getNamesProperty()
    {
        return [
            'admin',
            'Barop',
            'Caleb',
        ];
    }

    public function getTasksProperty()
    {
        switch ($this->name) {
        case 'admin':
            return ['CrossFit', 'Yoga', 'Halterofilia'];
        case 'Barop':
            return ['Laravel', 'Jetstream'];
        case 'Caleb':
            return ['Livewire', 'Sushi'];
        }

        return [];
    }

    public function eventReceive($event)
    {

        Clase::create([
            'monitor_id' => Auth::id(),
            'fecha_hora' => Carbon::createFromTimeString($event['start'])->subHour(),
            'vacantes' => $this->vacantes,
            'idevent' => $event['id'],
        ]);

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
        }

        $this->emit("refreshCalendar");

        //dd($clase);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
