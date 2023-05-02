<x-app-layout>

    <x-slot:header>
        {{ __('La famille') }}
        @isset($father->user->lname)
            {{ $father->user->lname }}
        @endisset

        <a href="{{ route('families.create') }}" title="Ajouter une nouvelle famille" class="btn-nav btn-border-create">
            <x-icons.plus />
        </a>

    </x-slot:header>

    <div class="grid grid-cols-12 gap-4">

        {{-- CLIENTS --}}

        {{-- FATHER --}}
        <x-cards.inner-card class="col-span-full md:col-span-6 bg-white">
            @if (empty($father))
                <x-modal openning-event='open-add-father-modal'
                    class="basis-10/12 rounded-lg md:basis-8/12 lg:basis-6/12">
                    <x-forms.clients.create action="{{ route('clients.store') }}" bag="father">
                        <x-slot:form_heading>
                            Ajouter le père
                        </x-slot:form_heading>

                        <x-slot:hidden_fields>
                            <input type="hidden" name="family_title" value="father">
                            <input type="hidden" name="family_id" value="{{ $family_id }}">
                        </x-slot:hidden_fields>
                    </x-forms.clients.create>
                </x-modal>

                @if ($errors->hasBag('father'))
                    <i x-data x-init="$dispatch('open-add-father-modal')"></i>
                @endif

                <div class="h-full grid">
                    <button x-data x-on:click="$dispatch('open-add-father-modal')"
                        class="place-self-center py-2 px-4 btn-fill-create rounded-full">
                        <x-icons2.plus class="w-8 h-8 inline" />
                        Ajouter le père
                    </button>
                </div>
            @else
                <x-cards.client1 :client-data="$father">
                    <x-slot:card_heading> Le père </x-slot:card_heading>

                    <div class="flex items-center">
                        <a href="{{ route('clients.show', ['client' => $father->id]) }}" title="Voir"
                            class="btn-nav btn-border-read">
                            <x-icons.eye />
                        </a>

                        <a href="{{ route('clients.edit', ['client' => $father->id]) }}" title="Modifier"
                            class="btn-nav btn-border-update">
                            <x-icons.pencil />
                        </a>
                    </div>

                </x-cards.client1>
            @endif
        </x-cards.inner-card>

        {{-- MOTHER --}}
        <x-cards.inner-card class="col-span-full md:col-span-6 bg-white">
            @if (empty($mother))
                <x-modal openning-event='open-add-mother-modal'
                    class="basis-10/12 rounded-lg md:basis-8/12 lg:basis-6/12">
                    <x-forms.clients.create action="{{ route('clients.store') }}" bag="mother">
                        <x-slot:hidden_fields>
                            <input type="hidden" name="family_title" value="mother">
                            <input type="hidden" name="family_id" value="{{ $family_id }}">
                        </x-slot:hidden_fields>

                        <x-slot:form_heading>
                            Ajouter la mère
                        </x-slot:form_heading>
                    </x-forms.clients.create>
                </x-modal>

                @if ($errors->hasBag('mother'))
                    <i x-data x-init="$dispatch('open-add-mother-modal')"></i>
                @endif

                <div class="h-full grid">
                    <button x-data x-on:click="$dispatch('open-add-mother-modal')"
                        class="place-self-center py-2 px-4 btn-fill-create rounded-full">
                        <x-icons2.plus class="w-8 h-8 inline" />
                        Ajouter la mère
                    </button>
                </div>
            @else
                <x-cards.client1 :client-data="$mother">
                    <x-slot:card_heading> La mère </x-slot:card_heading>

                    <div class="flex items-center">
                        <a href="{{ route('clients.show', ['client' => $mother->id]) }}" title="Voir"
                            class="btn-nav btn-border-read">
                            <x-icons.eye />
                        </a>
                        <a href="{{ route('clients.edit', ['client' => $mother->id]) }}" title="Modifier"
                            class="btn-nav btn-border-update">
                            <x-icons.pencil />
                        </a>
                    </div>

                </x-cards.client1>
            @endif
        </x-cards.inner-card>

        {{-- STUDENTS --}}
        <div class="col-span-12 grid grid-cols-12 gap-4">

            <div class="col-span-full text-xl px-2 border border-dashed border-gray-300 rounded-full">
                <span class="font-bold"> {{ $students->count() }} </span>
                {{ Str::plural('enfant', $students->count()) }}
            </div>

            <div class="col-span-full">
                <button x-data x-on:click="$dispatch('open-add-student-modal')"
                    class="place-self-center py-2 px-4 btn-fill-create rounded-full">
                    <x-icons2.plus class="w-8 h-8 inline" />
                    Ajouter un enfant
                </button>
            </div>

            <x-modal openning-event='open-add-student-modal' class="rounded-lg lg:basis-8/12">

                <x-forms.students.create>
                    <x-slot:hidden_fields>
                        <input type="hidden" name="family_id" value="{{ $family_id }}">
                    </x-slot:hidden_fields>

                    <x-slot:form_heading>
                        Ajouter un fils (élève)
                    </x-slot:form_heading>
                </x-forms.students.create>

            </x-modal>

            @if ($errors->hasBag('student'))
                <i x-data x-init="$dispatch('open-add-student-modal')"></i>
            @endif

            @foreach ($students as $student)
                <x-cards.inner-card class="col-span-full md:col-span-6 xl:col-span-4">

                    <x-cards.student1 :student="$student" class="h-full">
                        <x-slot:card_heading> Élève </x-slot:card_heading>

                        <div class="flex items-center">
                            <a href="{{ route('students.board', ['student' => $student->id]) }}" title="Voir"
                                class="btn-nav btn-fill-read">
                                <x-icons.eye />
                            </a>

                            <a href="{{ route('students.edit', ['student' => $student->id]) }}" title="Modifier"
                                class="btn-nav btn-border-update">
                                <x-icons.pencil />
                            </a>
                        </div>

                    </x-cards.student1>

                </x-cards.inner-card>
            @endforeach

        </div>
    </div>

</x-app-layout>
