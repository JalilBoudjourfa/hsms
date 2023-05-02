<x-app-layout>

    <x-slot:header>
        <div class="mr-4">
            {{ strtoupper($establishment_year->composed_key) }} > Sales (Affectations + Capacités)
        </div>

        <a href="{{ route('establishment-years.show', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Voir les classes" class="btn-nav btn-border-read">
            <x-icons.eye />
        </a>

        <a href="{{ route('classrooms_states.edit', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Activer ou désactiver des classes" class="btn-nav btn-fill-update">
            <x-icons.pencil />
        </a>
    </x-slot:header>

    {{-- AJOUTER UNE NOUVELLE SALLE --}}
    <x-forms.new-room-slot :active-classrooms="$active_classrooms" :establishment-year="$establishment_year" />

    {{-- error bag keys conflict when it comes to 'capacity(min)|(max).*' --}}

    {{-- Update rooms --}}
    <form action={{ route('rooms_capacities.update', ['establishment_year' => $establishment_year->composed_key]) }}
        method="post">

        @csrf
        {{-- EstablishmentYear --}}
        <input type="hidden" name="year_id" value="{{ $establishment_year->year_id }}">
        <input type="hidden" name="establishment_id" value="{{ $establishment_year->establishment_id }}">

        @foreach ($rooms_by_cycle as $cycle => $rooms)
            <div class="grid grid-cols-4 gap-x-4 gap-y-2 mb-8">

                <h3 class="col-span-full px-2 border border-dashed border-gray-300 rounded-full">
                    {{ ucfirst($cycle) }}:
                </h3>

                @foreach ($rooms as $room)
                    <x-cards.inner-card class="col-span-full lg:col-span-2 hover:border">

                        <x-forms.room-slot :room="$room" :active-classrooms="$active_classrooms" />

                    </x-cards.inner-card>
                @endforeach

            </div>
        @endforeach

        <button type="submit" class="btn-action btn-fill-update"> Mettre à jour </button>

    </form>

</x-app-layout>
