<?php

namespace App\Http\Livewire\Billing;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Invoices extends Component
{
    protected $listeners = [
        'render' => 'render',
    ];

    public function render()
    {
        $invoices = Auth::user()->invoices();

        return view('livewire.billing.invoices', [
            'invoices' => $invoices,
        ]);
    }
}
