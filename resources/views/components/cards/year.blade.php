<div class="max-w-xs rounded-lg overflow-hidden shadow-lg m-2">

    <img class="w-full" src="https://via.placeholder.com/250x150" alt="Sunset in the mountains">

    <div class="bg-white px-6 py-4">

        <h3 class="font-bold text-xl mb-2"> {{ strtoupper($establishment) }} </h3>

        <div class="flex items-center">

            <a href="{{ route('establishment-years.show', ['establishment_year' => $composed_key]) }}"
                title="Voir les classes" class="btn-nav btn-border-read">
                <x-icons.eye />
            </a>

            <a href="{{ route('classrooms_states.edit', ['establishment_year' => $composed_key]) }}"
                title="Activer ou désactiver des classes" class="btn-nav btn-fill-update">
                <x-icons.pencil />
            </a>

            <a href="{{ route('rooms_capacities.edit', ['establishment_year' => $composed_key]) }}"
                title="Modifier les salles" class="btn-nav btn-fill-update-alt">
                <x-icons.pencil />
            </a>

        </div>

    </div>

</div>
