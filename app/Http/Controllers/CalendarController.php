<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $appointments = Clase::with(['monitor'])->get();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => explode(' ', $appointment->monitor->name)[0],
                'start' => $appointment->fecha_hora,
                'end' => $appointment->fecha_hora->addHour(),
            ];
        }

        return view('admin.indexcal', [
            'events' => $events,
        ]);
    }
}
