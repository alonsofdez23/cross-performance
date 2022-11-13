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

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Denominación
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Clases
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-right">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entrenos as $entreno)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                            <a href="{{ route('entrenos.show', $entreno) }}">
                                                {{ $entreno->denominacion }}
                                            </a>
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $entreno->clases->count() }}
                                        </td>
                                        <td class="flex justify-end py-4 px-6">
                                            <button type="submit" class="inline-flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                <svg aria-hidden="true" class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                                <a href="{{ route('entrenos.edit', $entreno) }}">
                                                    Editar
                                                </a>
                                            </button>
                                            <form action="{{ route('entrenos.destroy', $entreno) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    <svg aria-hidden="true" class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    Borrar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>



            </div>
            <div class="flex justify-center pb-4 rounded-md shadow-sm" role="group">
                <a href="{{ route('entrenos.create') }}"
                class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuevo entreno
                </a>
                {{-- <button type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                    Settings
                </button>
                <button type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd"></path></svg>
                    Downloads
                </button> --}}
            </div>

        </div>
    </div>
</x-app-layout>
