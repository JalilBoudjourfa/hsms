<x-app-layout>

    <x-slot:header>
        {{ __('Liste des parents') }}
    </x-slot:header>

    {{-- <td class="px-2 py-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full"
                    src="https://ui-avatars.com/api/?name={{ $client->user->fname }}+{{ $client->user->lname }}&background=random&bold=true"
                    alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ $client->user->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ $client->profession }}
                </div>
            </div>
        </div>
    </td> --}}

    @livewire('table-clients')

</x-app-layout>
