{{-- <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <i class="fa-regular fa-wave-pulse block h-12 w-auto"></i>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl">
        Welcome to your Jetstream application!
    </div>

    <div class="mt-6 text-gray-500">
        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
        ecosystem to be a breath of fresh air. We hope you love it.
    </div>
</div> --}}

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <a href="{{ route('clases.index') }}" class="flex items-center justify-center">
            <i class="fa-solid fa-bookmark fa-xl text-gray-400"></i>
            <div class="ml-3 text-lg text-gray-600 leading-7 font-semibold">Clases</div>
        </a>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <a href="{{ route('chat.index') }}" class="flex items-center justify-center">
            <i class="fa-solid fa-message fa-xl text-gray-400"></i>
            <div class="ml-3 text-lg text-gray-600 leading-7 font-semibold">Chat</div>
        </a>
    </div>

    <div class="p-6 border-t border-gray-200">
        <a href="{{ route('billing.index') }}" class="flex items-center justify-center">
            <i class="fa-solid fa-credit-card fa-xl text-gray-400"></i>
            <div class="ml-3 text-lg text-gray-600 leading-7 font-semibold">Pagos</div>
        </a>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <a href="" class="flex items-center justify-center">
            <i class="fa-solid fa-chart-simple fa-xl text-gray-400"></i>
            <div class="ml-3 text-lg text-gray-600 leading-7 font-semibold">Benchmark</div>
        </a>
    </div>
</div>
