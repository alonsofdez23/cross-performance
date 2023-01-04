<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

                <div class="grid grid-cols-3 divide-x divide-gray-700">
                    <div class="col-span-1">
                        <div class="bg-gray-300 h-16 flex items-center px-4">
                            <img class="w-10 h-10 object-cover object-center" src="{{ Auth::user()->profile_photo_url }}">
                        </div>

                        <div class="bg-gray-200 h-14 flex items-center px-4">
                            <x-jet-input type="text"
                                class="w-full"
                                placeholder="Buscar" />
                        </div>
                        <div class="h-[calc(100vh-18.5rem)] overflow-auto border-t border-gray-700">

                        </div>
                    </div>
                    <div class="col-span-2">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
