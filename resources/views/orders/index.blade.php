<x-app-layout>
     @foreach ($orders as $order)
<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                <div class="flex justify-between items-center">
                    <div class="ml-2 text-sm text-gray-600">
                        Name:<span class="text-lg text-gray-800"> {{ $order->name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ $order->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($order->created_at->eq($order->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('order.edit', $order)">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    </div>
                    <div>
                    <small class="ml-2 text-sm text-gray-600">Duration: {{ $order->duration_minutes }}minutes.</small>
                    </div>
                    <div class="ml-2 text-sm text-gray-600">
                        Base Price:<span class="text-lg text-gray-800"> {{ $order->basePrice_cents / 100 }}€</span>
                    </div>
                    <p class="ml-2 my-4 text-gray-900">{{ $order->description }}</p>
                </div>

    </div>
    @endforeach
</x-app-layout>