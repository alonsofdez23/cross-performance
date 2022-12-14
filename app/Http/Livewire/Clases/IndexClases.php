<?php

namespace App\Http\Livewire\Clases;

use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IndexClases extends Component
{
    public $pickDay;
    public $atleta;

    protected $queryString = [
        'pickDay',
    ];

    public function mount(Request $request)
    {
        if (!$request->query()) {
            $this->pickDay = Carbon::now()->tz('Europe/Madrid')->format('d/m/Y');
        }

        //$this->pickDay = '2022-11-14';
    }

    public function currentDay()
    {
        $current = now()->tz('Europe/Madrid')->format('d/m/Y');

        $this->pickDay = $current;
    }

    public function dayBack()
    {
        $dayBack = Carbon::createFromFormat('d/m/Y',$this->pickDay)->subDay()->tz('Europe/Madrid')->format('d/m/Y');

        $this->pickDay = $dayBack;
    }

    public function dayForward()
    {
        $dayForward = Carbon::createFromFormat('d/m/Y',$this->pickDay)->addDay()->tz('Europe/Madrid')->format('d/m/Y');

        $this->pickDay = $dayForward;
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

    public function delete(User $atleta, Clase $clase)
    {
        $clase->atletas()->detach($atleta);

        $clase->vacantes = $clase->vacantes +1;
        $clase->save();
    }

    public function submit(Clase $clase)
    {
        $clase->atletas()->attach($this->atleta);

        $clase->vacantes = $clase->vacantes -1;
        $clase->save();
    }

    public function render()
    {
        $clases = Clase::whereDate('fecha_hora', $this->pickDay)->get()
            ->sortBy('fecha_hora');

        return view('livewire.clases.index-clases', [
            'clases' => $clases,
            'users' => User::all()->sortBy('id'),
        ]);
    }
}
