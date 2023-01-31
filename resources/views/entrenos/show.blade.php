<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-8 px-4 sm:py-8 sm:px-6 lg:max-w-7xl lg:px-8">

                <div class="grid grid-cols-1 gap-y-10 gap-x-6 xl:gap-x-8">

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

                        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                              <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $entreno->denominacion }}</h3>
                              <p class="mt-1 max-w-2xl text-sm text-gray-500">CrossFit</p>
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="bg-gray-50 mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <div>
                                        {!! $entreno->entreno !!}
                                    </div>
                                </div>
                            </div>
                          </div>


                    </div>

                </div>



            </div>

        </div>
    </div>
</x-app-layout>
