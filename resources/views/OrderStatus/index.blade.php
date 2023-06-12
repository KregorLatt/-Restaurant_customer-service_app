<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <label>{{ __('order date and time') }}
            <input type="datetime-local" name="order_time" value="{{ old('order_time') }}"
                step="900"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </label>
            <x-input-error :messages="$errors->get('order_time')" class="mt-2" />
                <label>{{ __('MenuItem')}}
                    <select name="MenuItem_id" id=""
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0" disabled selected>{{ __('Select MenuItem') }}</option>
                        @foreach ($MenuItems as $MenuItem)
                        <option value="{{$MenuItem->id}}" @selected(old('MenuItem_id')==$MenuItem->id) >{{ $MenuItem->name }}</option>
                        @endforeach
                    </select>
                </label>
                <x-input-error :messages="$errors->get('MenuItem_id')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Add order') }}</x-primary-button>
        </form> --}}
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($orders as $order)
            <div class="flex-1">
                <div>
                    <div class="flex justify-between items-center">
                    <div class="ml-2 text-sm text-gray-600">
                        order Time:<span class="text-lg text-gray-800"> {{ $order->order_time }}</span><br>
                        Server:<span class="text-lg text-gray-800"> {{ $order->server->name }}</span><br>
                        @if (isset($order->OrderStatus))
                        OrderStatus:<span class="text-lg text-gray-800"> {{ $order->OrderStatus->name }}</span>
                        @endif
                        {{-- <small class="ml-2 text-sm text-gray-600">{{ $order->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($order->created_at->eq($order->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless --}}
                    </div>
                    <form method="POST" action="{{ route('OrderStatus.update', $order) }}">
                        @csrf
                        @method('patch')
                        <x-primary-button>{{ __('Book now!') }}</x-primary-button>
                    </form>
                    <a href="{{route('OrderStatus.update', $order)}}">
                        {{ __('Book now') }}
                    </a>
                    {{-- @if ($order->OrderStatus->is(auth()->user()))
                    <a href="{{route('OrderStatus.destroy', $order)}}">
                        {{ __('Cancel order') }}
                    </a>
                    @endif --}}
                    </div>
                    @if (isset($order->MenuItem))
                    <div class="ml-2 text-sm text-gray-600">
                        MenuItem:<span class="text-lg text-gray-800"> {{ $order->MenuItem->name }}</span><br>
                        <small class="ml-2 text-sm text-gray-600">Duration: {{ $order->MenuItem->duration_minutes }}minutes.</small>
                    </div>
                    <div class="ml-2 text-sm text-gray-600">
                        Base Price:<span class="text-lg text-gray-800"> {{ $order->MenuItem->basePrice_cents / 100 }}€</span>
                    </div>
                    <p class="ml-2 my-4 text-gray-900">{{ $order->MenuItem->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>