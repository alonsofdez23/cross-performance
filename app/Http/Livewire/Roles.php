<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $openCreate = false;
    public $openEdit = false;
    public $openUser = false;

    public $usuarios;

    public $name, $rol;

    protected $rules = [
        'rol.name' => 'required|min:4|string',
    ];

    protected $listeners = [
        'render',
        'delete'
    ];

    protected $messages = [
        'name.required' => 'El nombre del rol es obligatorio.',
        'name.min' => 'El nombre del rol debe contener al menos 4 caracteres.',
    ];

    public function mount()
    {
        $this->usuarios = User::all();
    }

    public function cerrarModalEdit()
    {
        $this->reset('permiso_seleccionados');
        $this->openEdit = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:4',
        ]);

        Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);

        $this->reset(['openCreate', 'name']);

        $this->emit('render');
    }

    public function edit(Role $rol)
    {
        $this->rol = $rol;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->rol->save();

        $this->reset('openEdit');
    }

    public function delete(Role $rol)
    {
        $rol->delete();
    }

    public function removeRol(User $user, Role $rol)
    {
        $user->removeRole($rol);
    }

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => Role::all()->sortBy('id'),
        ]);
    }
}
