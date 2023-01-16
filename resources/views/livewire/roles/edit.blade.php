<x-jet-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        <div class="flex justify-center my-2 font-semibold uppercase">
            Editar rol
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-jet-label value="Nombre del rol" />
            <x-jet-input type="text" class="w-full" wire:model="rol.name" />
        </div>

    </x-slot>

    <x-slot name="footer">

        <x-jet-secondary-button wire:click="$set('openEdit', false)" wire:loading.remove class="mr-2">
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
