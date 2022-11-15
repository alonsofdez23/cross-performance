<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

                {{-- <div class="grid grid-cols-1 gap-y-10 gap-x-6 xl:gap-x-8"> --}}

                    <form action="{{ route('clases.addentreno.update', $clase) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mt-5">
                            <div class="mb-6">
                                <label for="entreno" class="block mb-2 text-sm font-medium text-gray-900">Entreno</label>
                                <select name="entreno" id="entreno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                                    <option selected>Elige entreno</option>
                                    @foreach ($entrenos as $entreno)
                                        <option value="{{ $entreno->id }}">{{ $entreno->denominacion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-center pb-4" role="group">
                            <button type="submit" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                <svg aria-hidden="true" class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Añadir entreno
                            </button>
                        </div>

                    </form>

                {{-- </div> --}}

            </div>

        </div>
    </div>
</x-app-layout>
