<x-app-layout>

    <x-slot:header>
        <div class="mr-4">
            {{ strtoupper($establishment_year->composed_key) }} > Classes
        </div>

        <a href="{{ route('establishment-years.show', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Voir les classes" class="btn-nav btn-border-read">
            <x-icons.eye />
        </a>

        <a href="{{ route('rooms_capacities.edit', ['establishment_year' => $establishment_year->composed_key]) }}"
            title="Modifier les salles" class="btn-nav btn-fill-update-alt">
            <x-icons.pencil />
        </a>
    </x-slot:header>

    <form action={{ route('classrooms_states.update', ['establishment_year' => $establishment_year->composed_key]) }}
        method="post">

        @csrf
        <input type="hidden" name="year_id" value="{{ $establishment_year->year_id }}">
        <input type="hidden" name="establishment_id" value="{{ $establishment_year->establishment_id }}">

        @foreach ($classroomsByCycle as $cycle => $classrooms)
            <div class="grid grid-cols-12 gap-y-2 gap-x-4 mb-8">

                <h3 class="col-span-12 px-2 border border-dashed border-gray-300 rounded-full">
                    {{ ucfirst($cycle) }}:
                </h3>

                @foreach ($classrooms as $classroom)
                    <x-cards.inner-card class="col-span-full md:col-span-6 lg:col-span-4 2xl:col-span-3 hover:ring-4 hover:ring-offset-4 hover:ring-blue-500/50">

                        <x-forms.classroom-slot :classroom="$classroom" />

                    </x-cards.inner-card>
                @endforeach

            </div>
        @endforeach

        <button type="submit" class="btn-action btn-fill-update-alt"> Mettre à jour </button>

    </form>

</x-app-layout>
