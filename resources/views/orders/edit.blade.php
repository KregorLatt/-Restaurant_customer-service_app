<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('orders.update', $order) }}">
            @csrf
            @method('patch')
            <label>{{ __('order date and time') }}
                                                                                                                        {{-- yyyy-MM-ddThh:mm --}}
                <input type="datetime-local" name="order_time" value="{{ old('order_time', \Carbon\Carbon::parse($order->order_time)->toDateTimeLocalString()) }}"
                    step="900"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </label>
                <x-input-error :messages="$errors->get('order_time')" class="mt-2" />
                    <label>{{ __('MenuItem')}}
                        <select name="MenuItem_id" id=""
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="0" disabled selected>{{ __('Select MenuItem') }}</option>
                            @foreach ($MenuItems as $MenuItem)
                            <option value="{{$MenuItem->id}}" @selected(old('MenuItem_id',$order->MenuItem_id)==$MenuItem->id) >{{ $MenuItem->name }}</option>
                            

                            @endforeach
                        </select>
                    </label>
                    <x-input-error :messages="$errors->get('MenuItem_id')" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('orders.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
