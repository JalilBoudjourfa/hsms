<x-app-layout>

    <x-slot:header>
        {{ __('List des établissements') }}

        {{-- <a href="{{ route('establishment-years.create') }}"
            title="Ajouter une nouvelle année scolaire pour un établissement"
            class="">

            <x-icons.plus />
        </a> --}}
    </x-slot:header>

    @livewire('table-establishments')

</x-app-layout>
