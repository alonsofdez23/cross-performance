


<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-4 md:gap-6">

            <div class="block mb-8">
                <x-jet-button wire:click="$set('openCreate', true)">
                    Crear usuario
                </x-jet-button>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-3">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Usuario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Roles
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">buttons</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)

                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-semibold text-gray-900">

                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $user->name }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $user->email }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <ul class="max-w-md">
                                            @foreach ($user->roles as $rol)

                                                <li class="sm:py-1 py-0.5">
                                                    <span id="badge-dismiss-dark" class="inline-flex items-center px-2 py-1 mr-2 text-sm font-medium text-white bg-gray-600 rounded">
                                                        {{ $rol->name }}
                                                        <button wire:click="removeRol({{$user}}, {{$rol}})" type="button" class="inline-flex items-center p-0.5 ml-2 text-sm text-gray-300 bg-transparent rounded-sm hover:bg-gray-500 hover:text-white" data-dismiss-target="#badge-dismiss-dark" aria-label="Remove">
                                                            <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Remove badge</span>
                                                        </button>
                                                    </span>

                                                </li>

                                            @endforeach
                                        </ul>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-end">

                                        <x-jet-danger-button wire:click="edit({{$user}})" class="bg-gray-600 hover:bg-gray-500 focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-600 mr-2">Editar</x-jet-danger-button>
                                        @if ($user->id != Auth::id())
                                            <x-jet-danger-button wire:click="$emit('delete', {{$user}})">Eliminar</x-jet-danger-button>
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
        @include('livewire.usuarios.create')
    @endif

    @if ($openEdit)
        @include('livewire.usuarios.edit')
    @endif
    </div>
</div>
