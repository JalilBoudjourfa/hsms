<x-app-layout>

    <x-slot:header>
        {{ __('List des familles') }}


            <a href="{{ route('families.create') }}" title="Ajouter une nouvelle famille" class="btn-nav btn-border-create">
                <x-icons.plus />
            </a>


    </x-slot:header>

    @livewire('table-families')

</x-app-layout>
