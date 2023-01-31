<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

                <div class="grid grid-cols-1 gap-y-10 gap-x-6 xl:gap-x-8">

                <form action="{{ route('entrenos.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-6">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Título</label>
                        <input type="text" name="denominacion" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required="">
                    </div>
                    <div class="mb-6">
                        <label for="entreno" class="block mb-2 text-sm font-medium text-gray-900">Entreno</label>
                        <textarea id="entreno" name="entreno" rows="12" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500"></textarea>
                    </div>

                    <div class="flex justify-center pb-4" role="group">
                        <button type="submit" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Guardar entreno
                        </button>
                        {{-- <button type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                            Settings
                        </button>
                        <button type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <svg aria-hidden="true" class="mr-2 w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd"></path></svg>
                            Downloads
                        </button> --}}
                    </div>
                </form>

                </div>

            </div>

        </div>
    </div>
    @push('ckeditor')
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/translations/es.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#entreno'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                    language: 'es',
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>
