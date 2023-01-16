<x-jet-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        <div class="flex justify-center my-2 font-semibold uppercase">
            Editar roles
        </div>
    </x-slot>

    <x-slot name="content" class="flex flex-col">

        <div class="my-4">

                @foreach ($roles as $rol)
                    <div class="flex items-center mb-4">
                        <input wire:model="roles_seleccionados.{{$rol->name}}" id="default-checkbox" type="checkbox" value="{{ $rol->id }}" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 focus:ring-2">
                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$rol->name}}</label>
                    </div>
                @endforeach

        </div>
        @error('roles_seleccionados') <span class="text-red-500 error">{{ $message }}</span> @enderror
    </x-slot>

    <x-slot name="footer">

        <x-jet-secondary-button wire:click="cerrarModalEdit" wire:loading.remove class="mr-2">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button wire:click="update" wire:loading.remove wire:target="update" class="disabled:opacity-25">
            Editar
        </x-jet-button>

        <span wire:loading wire:target="update">
            <x-spinner size="6" class="mr-2" />
        </span>
    </x-slot>

</x-jet-dialog-modal>
