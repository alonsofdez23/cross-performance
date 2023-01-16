<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-4 md:gap-6">

            <div class="block mb-8">
                <x-jet-button wire:click="$set('openCreate', true)">
                    Crear rol
                </x-jet-button>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-3">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Usuarios
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">buttons</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $rol)

                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-semibold text-gray-900">
                                        {{ $rol->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <ul class="max-w-md divide-y divide-gray-200">
                                            @foreach ($rol->users as $user)

                                                <li class="pb-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-shrink-0">
                                                            <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $user->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $user->email }}
                                                            </p>
                                                        </div>
                                                        <i wire:click="removeRol({{$user}}, {{$rol}})" class="fa-solid fa-xmark fa-lg cursor-pointer"></i>

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-end">

                                        <x-jet-danger-button wire:click="edit({{$rol}})" class="bg-gray-600 hover:bg-gray-500 focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-600 mr-2">Editar</x-jet-danger-button>
                                        @if ($rol->users->isEmpty())
                                            <x-jet-danger-button wire:click="$emit('delete', {{$rol}})">Eliminar</x-jet-danger-button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

        @if ($openCreate)
            @include('livewire.roles.create')
        @endif

        @if ($openEdit)
            @include('livewire.roles.edit')
        @endif
    </div>
</div>
