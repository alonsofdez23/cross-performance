<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'end' => $appointment->final,
            ];
        }

        return view('admin.indexcal', [
            'events' => $events,
        ]);
    }

    public function crearclase(Request $request)
    {
        $data = $request->except('_token');
        dd($data);
        $clases = Clase::insert($data);
        return response()->json($clases);
    }

    public function getclase()
    {
        $events = [];

        $appointments = Clase::with(['monitor'])->get();

        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => explode(' ', $appointment->monitor->name)[0],
                'start' => $appointment->fecha_hora,
                'end' => $appointment->final,
            ];
        }

        return $events;
    }
}
