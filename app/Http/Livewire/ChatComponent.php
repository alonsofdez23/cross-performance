<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatComponent extends Component
{
    public $search;
    public $userChat, $chat;

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
        } else {
            $this->userChat = $user;
        }
    }

    public function render()
    {
        return view('livewire.chat-component')->layout('layouts.chat');
    }
}
