<?php

namespace App\Http\Livewire\Admin;

use App\Models\Clase;
use Carbon\Carbon;
use Livewire\Component;
use Label84\HoursHelper\Facades\HoursHelper;

class AdminHorario extends Component
{
    public $hora;
    public $monitor;
    public $vacantes;

    public function submit()
    {
        Clase::create([
            'monitor_id' => $this->monitor,
            'fecha_hora' => Carbon::createFromTimeString($this->hora),
            'vacantes' => $this->vacantes,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-horario');
    }
}
