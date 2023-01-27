<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{
    public $openCreate = false;
    public $openEdit = false;
    public $openShow = false;

    public $name, $email, $password, $password_confirmation;

    public $user;

    public $roles_seleccionados = [];

    protected $listeners = [
        'render',
        'delete'
    ];

    protected $rules = [
        'user.name' => 'required|min:4|string|max:255',
        'user.email' => 'required|string|email|max:255',
    ];

    protected $messages = [
        '*.required' => 'El campo es obligatorio.',
        '*.min' => 'El campo debe contener al menos 4 caracteres',
    ];

    // Funcion que cierra el modal que edita los usuarios y
    // resetea el valor de roles para que no interfiera en el create.
    public function cerrarModalEdit()
    {
        $this->reset('roles_seleccionados');
        $this->openEdit = false;
    }

    public function show(User $user)
    {
        $this->openShow = true;
        $this->user = $user;
    }

    public function save()
    {

        $this->validate([
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'roles_seleccionados' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->roles_seleccionados);

        $this->reset(['openCreate', 'name', 'email', 'password', 'password_confirmation', 'roles_seleccionados']);

        $this->emit('render');
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->roles_seleccionados = $user->roles()->pluck('id', 'name');
        $this->openEdit = true;
    }

    public function update()
    {
        if ($this->roles_seleccionados != null || !empty($this->roles_seleccionados)) {
            $this->rules['roles_seleccionados'] = 'exists:roles,name';
            $this->user->syncRoles($this->roles_seleccionados);
        }

        $this->reset(['openEdit', 'roles_seleccionados', 'password', 'password_confirmation']);

        $this->emit('render');
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function removeRol(User $user, Role $rol)
    {
        $user->removeRole($rol);
    }

    public function render()
    {
        return view('livewire.usuarios.index', [
            'users' => User::with('roles')->get()->sortBy('id'),
            'roles' => Role::all(),
        ]);
    }
}
