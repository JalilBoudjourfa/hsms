<x-app-layout>

    <x-slot:header>
        {{ __('Année scolaire') }} {{ $year->id }} - {{ __('Créer un cout') }}

        {{-- <a href="{{ route('') }}" title="">
            <x-icons.plus />
        </a> --}}

    </x-slot:header>

    <x-cards.inner-card class="col-span-full md:col-span-6 bg-white">
        <form action="{{ route('expenses.store', ['year' => $year->id]) }}" method="post">

            @csrf

            <div class="grid grid-cols-4 items-end gap-2 p-1">

                <h3 class="col-span-full text-xl"> </h3>

                <x-forms.input name="name" type="text" required class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Nom
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input name="value" type="number" inputmode="decimal" required min="0" step="1"
                    class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Montant
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input name="start_date" type="date" required
                    class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Date de début
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input name="end_date" type="date" required
                    class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Date de fin
                    </x-slot:label_text>
                </x-forms.input>

                <div class="col-span-full mt-2 flex items-center sm:col-span-2 md:col-span-1">
                    Optionel
                    <div x-data="{ on: false }" x-on:click="on = !on">

                        <x-icons2.toggle-on class="w-8 h-8 text-green-400" />
                        <x-icons2.toggle-off class="w-8 h-8 text-red-400" />

                        <input type="checkbox" name="mondatory" x-bind:value="on ? 1 : 0" checked="checked"
                            class="hidden">
                    </div>
                    Mondataire
                </div>

                <select name="expense_type"
                    class="col-span-full sm:col-span-2 md:col-span-1 bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 h-11 rounded-md">

                    <option disabled selected value> -- Séléctionnez une classe -- </option>

                    @foreach ($expense_types as $expense_type)
                        <option value="{{ $expense_type }}"> {{ __($expense_type) }} </option>
                    @endforeach
                </select>

                <textarea name="note" cols="30" rows="3"
                    class="col-span-full resize-none appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none p-2 rounded leading-tight"></textarea>

            </div>

            <div class="my-8 flex flex-col gap-8">
                @foreach ($classrooms_by_cycle_by_est as $cycle => $classrooms_by_est)
                    @foreach ($classrooms_by_est as $est => $classrooms)
                        <div class="relative p-2 flex flex-wrap gap-y-2 gap-x-6 border border-blue-300 rounded-md">

                            <h4 class="absolute -top-3 left-2 px-2 bg-white text-blue-500 font-bold">
                                {{ strtoupper($est) }} </h4>

                            @foreach ($classrooms as $classroom)
                                <div class="col-span-full mt-2 flex items-center sm:col-span-2 md:col-span-1">
                                    <div x-data="{ on: false }" x-on:click="on = !on" class="cursor-pointer">

                                        <x-icons2.toggle-on class="w-8 h-8 text-blue-500" />
                                        <x-icons2.toggle-off class="w-8 h-8 text-gray-200" />

                                        <input type="checkbox" name="classrooms[{{ $classroom->id }}]"
                                            x-bind:value="on ? 1 : 0" checked="checked" class="hidden">
                                    </div>

                                    {{ $classroom->classType->name }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endforeach
            </div>

            <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>

        </form>
    </x-cards.inner-card>

</x-app-layout>
