<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatComponent extends Component
{
    public $search;
    public $userChat, $chat;
    public $bodyMensaje;

    // Propiedades computadas
    public function getUsersProperty()
    {
        return User::when($this->search, function($query){
            $query->where(function($query){
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        })->get();
    }

    public function getMensajesProperty()
    {
        return $this->chat ? Mensaje::where('chat_id', $this->chat->id)->get() : [];
        //$this->chat->mensajes()->get()
    }

    // Métodos
    public function open_chat_user(User $user)
    {
        $chat = Auth::user()->chats()
            ->whereHas('users', function($query) use ($user){
                $query->where('user_id', $user->id);
            })
            ->has('users', 2)
            ->first();

        if ($chat) {
            $this->chat = $chat;
            $this->reset(
                'userChat',
                'bodyMensaje',
            );
        } else {
            $this->userChat = $user;
            $this->reset(
                'chat',
                'bodyMensaje',
            );
        }
    }

    public function enviarMensaje()
    {
        $this->validate([
            'bodyMensaje' => 'required',
        ]);

        if (!$this->chat) {
            $this->chat = Chat::create();

            $this->chat->users()->attach([
                Auth::id(),
                $this->userChat->id,
            ]);
        }

        $this->chat->mensajes()->create([
            'body' => $this->bodyMensaje,
            'user_id' => Auth::id(),
        ]);

        $this->reset(
            'bodyMensaje',
            'userChat',
        );
    }

    public function render()
    {
        return view('livewire.chat-component')->layout('layouts.chat');
    }
}
