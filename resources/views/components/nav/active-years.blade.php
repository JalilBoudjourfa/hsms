<div x-data="{ visible: false }">

    <x-nav.simple-anchor x-on:click="visible = !visible">
        <x-icons2.chevron-down class="w-6 h-6" x-bind:class="visible || '-rotate-90'" />
        <x-slot:label> Années scolaires Actifs...</x-slot:label>
    </x-nav.simple-anchor>

    <div class="flex p-2" x-show="visible" x-transition>

        <div class="bg-white w-1 ml-3 mr-2 rounded-lg"></div>

        <div class="flex-1">

            @foreach ($active_years as $establishment_year)
                <x-nav.simple-anchor {{-- Unable to use composed key --}}
                    href="{{ route('establishment-years.show', ['establishment_year' => $establishment_year->id]) }}">

                    <x-icons.calendar />

                    <x-slot:label> {{ $establishment_year->year_id }} {{ $establishment_year->establishment_id }}
                    </x-slot:label>

                </x-nav.simple-anchor>
            @endforeach

        </div>

    </div>
</div>
