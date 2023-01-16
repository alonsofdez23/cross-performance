<x-jet-dialog-modal wire:model="openCreate">

    <x-slot name="title">
        <div class="flex justify-center my-2 font-semibold uppercase">
            Crear usuario
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-jet-label value="Nombre" />
            <x-jet-input type="text" class="w-full" wire:model="name" />
            @error('name') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-jet-label value="Email" />
            <x-jet-input type="text" class="w-full" wire:model="email" />
            @error('email') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-jet-label value="Contraseña" />
            <x-jet-input type="password" class="w-full" name="password" wire:model="password" />
            @error('password') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-jet-label value="Repite la contraseña" />
            <x-jet-input type="password" class="w-full" name="password_confirmation" wire:model="password_confirmation" />
            @error('password_confirmation') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-10 mb-2">
            <div class="flex items-center mr-4">
                @foreach ($roles as $rol)
                <input wire:model="roles_seleccionados.{{$rol->name}}" value="{{ $rol->name }}" type="checkbox" name="roles_seleccionados" id="roles_seleccionados" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 focus:ring-2">
                <x-jet-label value="{{$rol->name}}" class="ml-1 mr-3 text-sm font-medium text-gray-900" />
                @endforeach
            </div>
        </div>
        @error('roles_seleccionados') <span class="text-red-500 error">{{ $message }}</span> @enderror

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('openCreate', false)" wire:loading.remove class="mr-2">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button wire:click="save" wire:loading.remove wire:target="save">
            Crear
        </x-jet-button>

        <span wire:loading wire:target="save">
            <x-spinner size="6" class="mr-2" />
        </span>
    </x-slot>

</x-jet-dialog-modal>
