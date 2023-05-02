<x-app-layout>

    <x-slot:header>
        {{ __("L'index des années scolaires") }}

        {{-- <a href="{{ route('establishment-years.create') }}"
            title="Ajouter une nouvelle année scolaire pour un établissement"
            class="">

            <x-icons.plus />
        </a> --}}
    </x-slot:header>

    @foreach ($establishment_years_by_year as $year => $establishment_years)
        <div class="mt-8 mb-2 flex items-center">
            <h2 class="text-green-700 text-2xl font-bold"> {{ $year }} </h2>

            <p class="text-sm text-gray-400"> {{ __(ucfirst($establishment_years->first()->year->state)) }} </p>

            <div class="bg-green-700 h-1 m-4 flex-1 rounded-lg"></div>
        </div>

        <div class="flex flex-wrap">
            @foreach ($establishment_years as $year)
                <x-cards.year establishment="{{ $year->establishment_id }}" composed-key="{{ $year->composed_key }}" />
            @endforeach
        </div>
    @endforeach


</x-app-layout>
