<x-app-layout>
    <div class="pb-12">
        @livewire('billing.subscriptions')

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('billing.payment-method-create')

            <div class="mt-8">
                @livewire('billing.payment-method-list')
            </div>
        </div>
    </div>
</x-app-layout>
