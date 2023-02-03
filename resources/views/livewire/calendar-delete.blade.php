<x-jet-dialog-modal wire:model="openAtletas">
    <x-slot name="title">
        <div class="flex justify-center my-6">
            <i class="fa-solid fa-triangle-exclamation fa-lg fa-beat"></i>
        </div>
        <div class="flex justify-center text-xl font-bold">
            Esta clase tiene atletas apuntados
        </div>
        <div class="flex justify-center">
            ¿Estás seguro que quieres eliminar la clase del&nbsp;<b>{{ $this->clase->fecha_hora->tz('Europe/Madrid')->format('d/m/Y \a \l\a\s G:i') }}</b>?
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="flex justify-center text-lg font-semibold">
            Atletas en clase
        </div>
        <div class="flex justify-center">
            <ul class="grid grid-cols-2 gap-x-4 max-w-md">
                @foreach ($this->clase->atletas as $atleta)
                    <li class="py-2">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-md" src="{{ $atleta->profile_photo_url }}" alt="{{ $atleta->name }}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $atleta->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $atleta->email }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-end pt-4 text-sm italic">
            *Todos los atletas serán notificados por email.
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('openAtletas', false)" class="mr-2">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button wire:click="deleteClase()">
            Aceptar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
