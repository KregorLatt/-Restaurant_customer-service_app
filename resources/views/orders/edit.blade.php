<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('orders.update', $order) }}">
            @csrf
            @method('delete')

                                                                                                                        {{-- yyyy-MM-ddThh:mm --}}



            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Delivere') }}</x-primary-button>
                <a href="{{ route('orders.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
