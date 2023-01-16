<x-jet-dialog-modal wire:model="openUser">

    <x-slot name="title">
        <div class="flex justify-center my-2 font-semibold uppercase">
            Crear rol
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-jet-label value="Selecciona usuario" />

            <select wire:model="usuarios" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                <option selected>Choose a country</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('openUser', false)" wire.loading.remove class="mr-2">
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
