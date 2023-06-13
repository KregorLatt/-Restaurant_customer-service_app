<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <x-input-error :messages="$errors->get('order_time')" class="mt-2" />

            @foreach ($MenuItems as $MenuItem)
                <option value="{{ $MenuItem->id}}" @selected(old("MenuItem_id")==$MenuItem->id) ></option>
            @endforeach

            <x-input-error :messages="$errors->get('MenuItem_id')" class="mt-2" />

        </form>
        @foreach ($orders as $order)

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="ml-2 text-sm text-gray-600">
                            order Time:<span class="text-lg text-gray-600"> {{ $order->order_time }}</span><br>
                            Server:<span class="text-lg text-gray-600"> {{ $order->server->name }}</span><br>
                            @if (isset($order->MenuItem))
                            <div class="ml-2 text-sm text-gray-600">
                                Order:<span class="ml-2 my-4 text-gray-800">{{ $order->MenuItem->description }}</span><br>
                                <small class="ml-2 text-sm text-gray-600">Duration:
                                    {{ $order->MenuItem->duration_minutes }}minutes.</small>
                            </div>
                            <div class="ml-2 text-sm text-gray-600">
                                Base Price:<span class="text-lg text-gray-800">
                                    {{ $order->MenuItem->basePrice_cents / 100 }}€</span>
                            </div>


                        @endif
                        </div>

                        @if ($order->server->is(auth()->user()))
                             <x-dropdown>
                                <x-slot name="trigger">

                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('orders.edit',['order' => $order])">
                                        {{ __('Edit') }}

                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <form method="POST"action="{{ route('orders.done', ['order' => $order]) }}" class="inline">
                                @csrf

                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    {{ __('done') }}
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
