<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">
                <form wire:submit.prevent="submit">

                    <div>
                        <x-jet-label for="hora" value="Hora" />
                        <x-jet-input wire:model="hora" id="hora" type="text" class="mt-1 block w-full" />
                        <x-jet-input-error for="hora" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="monitor" value="Monitor" />
                        <x-jet-input wire:model="monitor" id="monitor" type="text" class="mt-1 block w-full" />
                        <x-jet-input-error for="monitor" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="vacantes" value="Plazas disponibles" />
                        <x-jet-input wire:model="vacantes" id="vacantes" type="number" class="mt-1 block w-full" />
                        <x-jet-input-error for="vacantes" class="mt-2" />
                    </div>

            </div>
        </div>
    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-jet-button>
                            Guardar
                        </x-jet-button>
                    </div>
                </form>

</div>
