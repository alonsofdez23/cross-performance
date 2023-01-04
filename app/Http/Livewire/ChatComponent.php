<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ChatComponent extends Component
{
    public $search;

    // Propiedad computada
    public function getUsersProperty()
    {
        return User::when($this->search, function($query){
            $query->where(function($query){
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        })->get();
    }

    public function render()
    {
        return view('livewire.chat-component')->layout('layouts.chat');
    }
}
