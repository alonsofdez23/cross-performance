<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertaPago extends Component
{
    protected $listeners = [
        'render' => 'render',
    ];

    public function render()
    {
        return view('livewire.alerta-pago');
    }
}
