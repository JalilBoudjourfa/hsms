<x-app-layout>

    <x-slot:header>
        <div class="mr-4">
            {{ strtoupper($establishment_year->composed_key) }}
        </div>

        <a href="{{ route('classrooms_states.edit', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Activer ou désactiver des classes" class="btn-nav btn-fill-update">
            <x-icons.pencil />
        </a>

        <a href="{{ route('rooms_capacities.edit', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Modifier les salles" class="btn-nav btn-fill-update-alt">
            <x-icons.pencil />
        </a>
    </x-slot:header>

    @livewire('table-establishment-year-classrooms', ['establishmentYearId' => $establishment_year->id])

</x-app-layout>
