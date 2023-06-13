<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
           <label>{{ __('order time') }}
                <input type="datetime-local" name="order_time" value="{{ old('order_time') }}" step="900"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </label>
            <x-input-error :messages="$errors->get('order_time')" class="mt-2" />
            <label>{{ __('MenuItem') }}
                <select name="MenuItem_id" id=""
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">

                    <option value="0" disabled selected>{{ __('Select MenuItem') }}</option>
                    @foreach ($MenuItems as $MenuItem)
                        <option value="{{ $MenuItem->id}}" @selected(old("MenuItem_id")==$MenuItem->id) >{{ $MenuItem->name }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error :messages="$errors->get('MenuItem_id')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Order') }}</x-primary-button>
        </form>

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            @foreach ($orders as $order)
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <div>
                        <div class="flex justify-between items-center">
                            <div class="ml-2 text-sm text-gray-600">
                                Name:<span class="text-lg text-gray-800"> {{ $order->name }}</span><br>
                                Order Time:<span class="text-lg text-gray-800"> {{ $order->order_time }}</span><br>
                                Server:<span class="text-lg text-gray-800"> {{ $order->server->name }}</span><br>
                                @if ($order->client)
                                    Client:<span class="text-lg text-gray-800"> {{ $order->client->name }}</span>
                                @endif
                            </div>
                            <!-- Rest of your code -->
                        </div>
                        <!-- Rest of your code -->
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</x-app-layout>
