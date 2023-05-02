<x-app-layout>

    <x-slot:header>
        <span class="font-semibold">
            {{ $expense->year_id }}
        </span>
        :
        {{ $expense->name }}

    </x-slot:header>

    <x-cards.inner-card class="bg-white mb-4">
        <div class="p-2 border border-dotted border-blue-500 rounded-md">
            <div>
                Valeur:
                <span class="font-mono font-bold">
                    {{ number_format($expense->value, 2) }}
                    DZD
                </span>
            </div>

            <div>
                Période:
                {{ $expense->start_date?->toDateString() }}
                -
                {{ $expense->end_date?->toDateString() }}
            </div>

            <div class="flex flex-wrap gap-y-2 gap-x-3">

                @foreach ($expense->classrooms as $classroom)
                    <a href="{{ route('classrooms.registrations', ['classroom' => $classroom->id]) }}"
                        class="p-1 border rounded-md text-sm underline">
                        {{ $classroom->classType->alias }}
                        <span class="text-gray-700 text-xs">
                            {{ $classroom->establishmentYear->establishment_id }}
                        </span>
                    </a>
                @endforeach
            </div>

        </div>
    </x-cards.inner-card>

    <x-cards.inner-card class="col-span-full md:col-span-6 bg-white">

        <h3 class="text-blue-500 text-xl"> Modifier le payment: </h3>

        <form action="{{ route('expenses.update', ['expense' => $expense->id]) }}" method="post">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-4 items-end gap-2 p-1">

                <h3 class="col-span-full text-xl"> </h3>

                <x-forms.input value="{{ $expense->name }}" name="name" type="text" required
                    class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Nom
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input value="{{ $expense->value }}" name="value" type="number" inputmode="decimal" required
                    min="0" step="1" class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Valeur
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input value="{{ $expense->start_date?->toDateString() }}" name="start_date" type="date"
                    required class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Date de début
                    </x-slot:label_text>
                </x-forms.input>

                <x-forms.input value="{{ $expense->end_date?->toDateString() }}" name="end_date" type="date"
                    required class="col-span-full sm:col-span-2 md:col-span-1">
                    <x-slot:label_text>
                        Date de fin
                    </x-slot:label_text>
                </x-forms.input>

                <div class="col-span-full mt-2 flex items-center sm:col-span-2 md:col-span-1">
                    Optionel
                    <div x-data="{ on: {{ $expense->mondatory ? 'true' : 'false' }} }" x-on:click="on = !on">

                        <x-icons2.toggle-on class="w-8 h-8 text-green-400" />
                        <x-icons2.toggle-off class="w-8 h-8 text-red-400" />

                        <input name="mondatory" type="checkbox" x-bind:value="on ? 1 : 0" checked="checked"
                            class="hidden">
                    </div>
                    Mondataire
                </div>


                <select name="expense_type"
                    class="col-span-full sm:col-span-2 md:col-span-1 bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 h-11 rounded-md">

                    <option disabled selected value> -- Séléctionnez une classe -- </option>

                    <option value=""> - </option>

                    @foreach ($expense_types as $expense_type)
                        <option value="{{ $expense_type }}" @selected($expense->expense_type === $expense_type)> {{ __($expense_type) }}
                        </option>
                    @endforeach

                </select>

                <textarea name="note" cols="30" rows="3"
                    class="col-span-full resize-none appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none p-2 rounded leading-tight">{{ $expense->note }}</textarea>

            </div>

            <div class="my-8 flex flex-col gap-8">
                @foreach ($classrooms_by_cycle_by_est as $cycle => $classrooms_by_est)
                    @foreach ($classrooms_by_est as $est => $classrooms)
                        <div class="relative p-2 flex flex-wrap gap-y-2 gap-x-6 border border-blue-300 rounded-md">

                            <h4 class="absolute -top-3 left-2 px-2 bg-white text-blue-500 font-bold">
                                {{ strtoupper($est) }} </h4>

                            @foreach ($classrooms as $classroom)
                                @php
                                    $on = $expense->classrooms->where('id', $classroom->id)->count() ? 'true' : 'false';
                                @endphp

                                <div class="col-span-full mt-2 flex items-center sm:col-span-2 md:col-span-1">
                                    <div x-data="{ on: {{ $on }} }" x-on:click="on = !on" class="cursor-pointer">

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

            <button type="submit" class="btn-action btn-fill-update"> Mettre à jour </button>

        </form>
    </x-cards.inner-card>

</x-app-layout>
