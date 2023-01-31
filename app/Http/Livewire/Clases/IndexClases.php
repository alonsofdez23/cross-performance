<?php

namespace App\Http\Livewire\Clases;

use App\Models\Clase;
use App\Models\Entreno;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexClases extends Component
{
    public $pickDay;
    public $atleta;
    public $entrenoJoin;

    public $openUser = false;

    public $name, $email, $avatar;

    public $openEntreno = false;

    public $denominacion, $entreno;

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
        if ($this->atleta != null) {
            $clase->atletas()->attach($this->atleta);

            $clase->vacantes = $clase->vacantes -1;
            $clase->save();
        }

        /* if (session('clase_url')) {
            return redirect(session('clase_url'));
        } */
    }

    public function addEntreno(Clase $clase)
    {
        $clase->entreno_id = $this->entrenoJoin;
        $clase->save();
    }

    public function deleteEntreno(Clase $clase)
    {
        $clase->entreno_id = null;
        $clase->save();
    }

    public function showUser(User $atleta)
    {
        $this->openUser = true;

        $this->name = $atleta->name;
        $this->email = $atleta->email;
        $this->avatar = $atleta->profile_photo_url;
    }

    public function showMonitor(Clase $clase)
    {
        $this->openUser = true;

        $this->name = $clase->monitor->name;
        $this->email = $clase->monitor->email;
        $this->avatar = $clase->monitor->profile_photo_url;
    }

    public function showEntreno(Clase $clase)
    {
        $this->openEntreno = true;

        $this->denominacion = $clase->entreno->denominacion;
        $this->entreno = $clase->entreno->entreno;
    }

    public function render()
    {
        /* Session::put('clase_url', request()->fullUrl()); */

        $clases = Clase::whereDate('fecha_hora', $this->pickDay)->get()
            ->sortBy('fecha_hora');

        return view('livewire.clases.index-clases', [
            'clases' => $clases,
            'users' => User::all()->sortBy('id'),
            'entrenos' => Entreno::all(),
        ]);
    }
}
