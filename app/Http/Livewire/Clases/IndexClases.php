<?php

namespace App\Http\Livewire\Clases;

use App\Models\Clase;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IndexClases extends Component
{
    public $pickDay;

    public function mount()
    {
        $this->pickDay = Carbon::now()->tz('Europe/Madrid');
    }

    public function dayBack()
    {
        if (is_string($this->pickDay)) {
            $this->pickDay = Carbon::create($this->pickDay)->tz('Europe/Madrid');
        }

        $this->pickDay->subDay();
    }

    public function dayForward()
    {
        if (is_string($this->pickDay)) {
            $this->pickDay = Carbon::create($this->pickDay)->tz('Europe/Madrid');
        }

        $this->pickDay->addDay();
    }

    public function join(Clase $clase)
    {
        $clase->atletas()->attach(Auth::id());

        $clase->vacantes = $clase->vacantes -1;
        $clase->save();
    }

    public function leave(Clase $clase)
    {
        $clase->atletas()->detach(Auth::id());

        $clase->vacantes = $clase->vacantes +1;
        $clase->save();
    }

    public function render()
    {
        $clases = Clase::whereDate('fecha_hora', $this->pickDay)->get()
            ->sortBy('fecha_hora');

        return view('livewire.clases.index-clases', [
            'clases' => $clases,
        ]);
    }
}
