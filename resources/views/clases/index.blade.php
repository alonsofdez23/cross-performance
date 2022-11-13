<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

                <!-- Variable Session -->
                @if (session()->has('success'))
                    <div class="grid lg:grid-cols-3">
                        <div class="lg:col-start-2">
                            <div class="text-center bg-green-100 p-4 mb-4 text-sm text-green-700 rounded-lg" role="alert">
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="grid lg:grid-cols-3 gap-4">
                        <div class="lg:col-start-2">
                            <div class="text-center bg-red-100 p-4 mb-4 text-sm text-red-700 rounded-lg" role="alert">
                                <span class="font-semibold">{{ session('error') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-y-10 gap-x-6 xl:gap-x-8">

                    <ol class="relative border-l border-gray-500">
                        @foreach ($clases as $clase)
                            <li class="mb-10 ml-6">
                                <span class="flex absolute -left-4 justify-center items-center w-8 h-8 bg-gray-200 rounded-full ring-8 ring-white">
                                    <svg aria-hidden="true" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </span>
                                <h3 class="flex items-center ml-2 mb-1 text-xl font-semibold text-gray-900">{{ $clase->fecha_hora->tz('Europe/Madrid')->toTimeString() }} <span class="
                                    @if (!$clase->vacantes == 0)
                                        bg-green-100 text-green-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                        text-base font-medium mr-2 px-2.5 py-0.5 rounded ml-3">{{ $clase->vacantes }}</span>
                                    @if ($clase->entreno != null)
                                        <a href="{{ route('entrenos.show', $clase->entreno) }}" class="text-base font-medium mr-2 px-2.5 py-0.5 rounded ml-3">
                                            Entreno
                                        </a>
                                    @endif
                                </h3>
                                <div class="mt-6 grid grid-cols-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-6">
                                    @foreach ($clase->atletas as $atleta)
                                        <div><img class="rounded-2xl" src="{{ $atleta->profile_photo_url }}" alt="{{ $atleta->name }}"></div>
                                    @endforeach
                                </div>
                            </li>

                            <div class="flex ml-6 mb-6 pb-4 rounded-md" role="group">
                                @if ($clase->vacantes == 0)
                                    <button type="button" class="inline-flex items-center cursor-not-allowed py-2 px-4 text-sm font-medium text-gray-900 bg-red-100 rounded-md border border-gray-200 hover:bg-red-200 hover:text-gray-700">
                                        <svg aria-hidden="true" class="w-4 h-4 text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                    </button>
                                @elseif (!$clase->atletas->contains(Auth::user()))
                                    <form action="{{ route('clases.join', $clase) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-green-100 rounded-md border border-gray-200 hover:bg-green-200 hover:text-gray-700 focus:bg-green-400">
                                            <svg aria-hidden="true" class="w-4 h-4 fill-current text-green-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('clases.leave', $clase) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-red-100 rounded-md border border-gray-200 hover:bg-red-200 hover:text-gray-700 focus:bg-red-400">
                                            <svg aria-hidden="true" class="w-4 h-4 fill-current text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                {{-- <button type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-gray-700 focus:text-gray-700">
                                    <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                                    Settings
                                </button> --}}

                            </div>
                        @endforeach
                    </ol>

                </div>



            </div>

        </div>
    </div>
</x-app-layout>
