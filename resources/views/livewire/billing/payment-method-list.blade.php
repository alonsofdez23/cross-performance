<div>
    <section class="card relative bg-white p-4 rounded-md shadow-md shadow-gray-400">
        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20" />
        </div>

        <div class="px-6 py-4 mb-4 bg-gray-200 rounded-md">
            <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregado</h1>
        </div>
        <div class="card-body divide-y divide-gray-200">
            @forelse ($paymentMethods as $paymentMethod)
                <article class="text-sm text-gray-700 py-2 flex justify-between items-center">
                    <div>
                        <h1><span class="font-bold">{{ $paymentMethod->billing_details->name }}</span> XXXX-{{ $paymentMethod->card->last4 }}
                        @if ($paymentMethod->id == Auth::user()->defaultPaymentMethod()->id)
                            <span class="p-1 px-2 ml-4 border bg-gray-200 border-gray-200 text-gray-700 rounded">Predeterminado</span>
                        @endif
                        </h1>
                        <p>Expira {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                    </div>
                    <div class="grid grid-cols-2 border border-gray-200 rounded text-gray-500 divide-x divided-gray-200">
                        @unless ($paymentMethod->id == Auth::user()->defaultPaymentMethod()->id)
                            <i class="fas fa-star cursor-pointer p-3 hover:text-gray-700" wire:click="defaultPaymentMethod('{{ $paymentMethod->id }}')"></i>
                            <i class="fas fa-trash cursor-pointer p-3 hover:text-gray-700" wire:click="deletePaymentMethod('{{ $paymentMethod->id }}')"></i>
                        @endunless
                    </div>
                </article>
            @empty

                <article class="p-2">
                    <h1 class="text-sm text-gray-700">No cuentas con ningún método de pago</h1>
                </article>

            @endforelse
        </div>
    </section>
</div>
