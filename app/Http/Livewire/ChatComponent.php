<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Mensaje;
use App\Models\User;
use App\Notifications\MensajeLeido;
use App\Notifications\NuevoMensaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ChatComponent extends Component
{
    public $search;
    public $userChat, $chat;
    public $bodyMensaje;

    // Listeners
    public function getListeners()
    {
        $user_id = Auth::id();

        return [
            "echo-notification:App.Models.User.{$user_id},notification" => 'render',
        ];
    }

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
        return $this->chat ? Mensaje::where('chat_id', $this->chat->id)->get()->sortBy('created_at') : [];
        //$this->chat->mensajes()->get()
    }

    public function getChatsProperty()
    {
        return Auth::user()->chats()->get()->sortByDesc('ultimo_mensaje');
    }

    public function getNotificacionesUsuariosProperty()
    {
        return $this->chat ? $this->chat->users->where('id', '!=', Auth::id()) : [];
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
                'search',
            );
        } else {
            $this->userChat = $user;
            $this->reset(
                'chat',
                'bodyMensaje',
                'search',
            );
        }
    }

    public function open_chat(Chat $chat)
    {
        $this->chat = $chat;
        $this->reset(
            'userChat',
            'bodyMensaje',
        );
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

        Notification::send($this->notificaciones_usuarios, new NuevoMensaje());

        $this->reset(
            'bodyMensaje',
            'userChat',
        );
    }

    public function render()
    {
        if ($this->chat) {
            $this->chat->mensajes()->where('user_id', '!=', Auth::id())->where('leido', false)->update([
                'leido' => true,
            ]);

            $this->emit('scrollIntoView');
        }

        return view('livewire.chat-component');
    }
}
