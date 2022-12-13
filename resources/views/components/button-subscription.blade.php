@props(['name', 'price'])

<div class="w-full">
    @if (Auth::user()->hasDefaultPaymentMethod())
        @if (Auth::user()->subscribed($name))
            @if (Auth::user()->subscribedToPrice($price, $name))
                @if (Auth::user()->subscription($name)->onGracePeriod())
                    <button wire:click="resumingSubscription('{{ $name }}')"
                        wire:loading.remove
                        wire:target="resumingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Reanudar tarifa
                    </button>

                    <!-- Botón disabled -->
                    <button wire:loading.flex
                        wire:target="resumingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size="6" class="mr-2" />

                        Reanudar tarifa
                    </button>
                @else
                    <button wire:click="cancellingSubscription('{{ $name }}')"
                        wire:loading.remove
                        wire:target="cancellingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Cancelar
                    </button>

                    <!-- Botón disabled -->
                    <button wire:loading.flex
                        wire:target="cancellingSubscription('{{ $name }}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size="6" class="mr-2" />

                        Cancelar
                    </button>
                @endif
            @else
                <button wire:click="changingPlans('{{ $name }}', '{{ $price }}')"
                    wire:loading.remove
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cambiar tarifa
                </button>

                <!-- Botón disabled -->
                <button wire:loading.flex
                    wire:target="changingPlans('{{ $name }}', '{{ $price }}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner size="6" class="mr-2" />

                    Cambiar tarifa
                </button>
            @endif
        @else

            <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
                wire:loading.remove
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Suscribirse
            </button>

            <!-- Botón disabled -->
            <button wire:loading.flex
                wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size="6" class="mr-2" />

                Suscribirse
            </button>
        @endif
    @else
        <button
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            Agregar método de pago
        </button>
    @endif
</div>
