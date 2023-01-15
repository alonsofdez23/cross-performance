<x-jet-dialog-modal wire:model="openCreate">

    <x-slot name="title">
        <div class="flex justify-center my-2 font-semibold uppercase">
            Crear rol
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-jet-label value="Nombre del rol" />
            <x-jet-input type="text" class="w-full" wire:model="name" />
            @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('openCreate', false)" wire.loading.remove class="mr-2">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button wire:click="save" wire:loading.remove wire:target="save" class="disabled:opacity-25">
            Crear
        </x-jet-button>

        <span wire:loading wire:target="save">
            <x-spinner size="6" class="mr-2" />
        </span>
    </x-slot>

</x-jet-dialog-modal>
