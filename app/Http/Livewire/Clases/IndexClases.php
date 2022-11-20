<?php

namespace App\Http\Livewire\Clases;

use App\Models\Clase;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IndexClases extends Component
{
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
        $clases = Clase::whereDay('fecha_hora', 14)->get()
            ->sortBy('fecha_hora');

        return view('livewire.clases.index-clases', [
            'clases' => $clases,
        ]);
    }
}
