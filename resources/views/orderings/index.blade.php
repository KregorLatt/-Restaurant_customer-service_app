<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <label>{{ __('Ordering date and time') }}
                <input type="datetime-local" name="ordering_time" value="{{ old('ordering_time') }}" step="900"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </label>
            <x-input-error :messages="$errors->get('ordering_time')" class="mt-2" />
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
            <x-primary-button class="mt-4">{{ __('Add Ordering') }}</x-primary-button>
        </form>
        @foreach ($orderings as $ordering)
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="ml-2 text-sm text-gray-600">
                            ordering Time:<span class="text-lg text-gray-800"> {{ $ordering->ordering_time }}</span><br>
                            Server:<span class="text-lg text-gray-800"> {{ $ordering->server->name }}</span><br>
                            @if (isset($ordering->client))
                                Client:<span class="text-lg text-gray-800"> {{ $ordering->client->name }}</span>
                            @endif
                            {{-- <small class="ml-2 text-sm text-gray-600">{{ $ordering->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($ordering->created_at->eq($ordering->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless --}}
                        </div>
                        @if ($ordering->server->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('orderings.edit', $ordering)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                    @if (isset($ordering->MenuItem))
                        <div class="ml-2 text-sm text-gray-600">
                            MenuItem:<span class="text-lg text-gray-800"> {{ $MenuItem->name }}</span><br>
                            <small class="ml-2 text-sm text-gray-600">Duration:
                                {{ $ordering->MenuItem->duration_minutes }}minutes.</small>
                        </div>
                        <div class="ml-2 text-sm text-gray-600">
                            Base Price:<span class="text-lg text-gray-800">
                                {{ $ordering->MenuItem->basePrice_cents / 100 }}€</span>
                        </div>
                        <p class="ml-2 my-4 text-gray-900">{{ $ordering->MenuItem->description }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>