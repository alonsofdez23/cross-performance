<?php

namespace App\Http\Livewire\Admin;

use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Label84\HoursHelper\Facades\HoursHelper;

class AdminHorario extends Component
{
    public $horaInicio;
    public $horaFin;
    public $duracion;
    public $dia;

    public $monitor;
    public $vacantes;

    public function submit()
    {
        $horario = HoursHelper::create(
            $this->dia . ' ' . $this->horaInicio,
            $this->dia . ' ' . $this->horaFin,
            $this->duracion,
            'Y-m-d H:i',
        );

        foreach ($horario as $clase) {
            Clase::create([
                'monitor_id' => $this->monitor,
                'fecha_hora' => Carbon::createFromTimeString($clase)->subHour(),
                'vacantes' => $this->vacantes,
            ]);
        }

        /* Clase::create([
            'monitor_id' => $this->monitor,
            'fecha_hora' => Carbon::createFromTimeString($this->hora),
            'vacantes' => $this->vacantes,
        ]); */
    }

    public function render()
    {
        $monitores = User::role('admin')->get();

        return view('livewire.admin.admin-horario', [
            'monitores' => $monitores,
        ]);
    }
}
