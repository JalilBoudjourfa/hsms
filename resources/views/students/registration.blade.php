<x-app-layout>

    <x-slot:header>
        {{ $studentRegistration->student->user->name }} (<span class="">
            {{ $studentRegistration->student->arabic_full_name }} </span>)


        <a href="{{ route('families.board', ['family' => $studentRegistration->student->family_id]) }}"
            title="Voir la famille" class="btn-nav btn-fill-read-alt">

            <x-icons.user-group />
        </a>

        <a href="{{ route('students.board', ['student' => $studentRegistration->student->id]) }}" title="Voir"
            class="btn-nav btn-fill-read">

            <x-icons.eye />
        </a>

    </x-slot:header>

    <div class="grid grid-cols-4 gap-5">

        {{-- <section class="col-span-full">
            <button x-data x-on:click="$dispatch('open-add-student-interview-modal')"
                class="place-self-center py-2 px-4 border btn-border-create rounded-full">
                <x-icons2.calendar class="w-8 h-8 inline" />
                Donner un rendez vous d'entretien
            </button>
        </section>
        <x-modal openning-event='open-add-student-interview-modal'
            class="col-span-10 col-start-2 justify-self-center rounded-lg md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4">
            <x-forms.students-interview.create :reg-id="$studentRegistration->student->latestRegistration->id" />
        </x-modal> --}}

        <x-cards.inner-card class="col-span-3">

            <div class="grid grid-cols-1 gap-y-2 items-center p-2">

                <div class="border-b ">
                    <span class="font-semibold"> Date de déposition du dossier :</span>
                    {{ $studentRegistration->deposition_date->format('d-M-Y') }}
                </div>

                <div>
                    <span class="font-semibold"> Nom et Prénom :</span> {{ $studentRegistration->student->user->name }}
                    (<span class="">
                        {{ $studentRegistration->student->arabic_full_name }} </span>)
                </div>

                <div><span class="font-semibold"> Genre :</span> {{ $studentRegistration->student->sex }}</div>

                <div><span class="font-semibold"> Date et lieu de naissance :</span>
                    {{ $studentRegistration->student->bday->format('m-M-Y') }} à
                    {{ $studentRegistration->student->bplace }}</div>

                <div><span class="font-semibold"> Nationalité :</span>

                    {{ $studentRegistration->student->nationality }}
                </div>

                @isset($studentRegistration->exRegistration)
                    <div><span class="font-semibold"> L'ancien établissement :</span>
                        {{ $studentRegistration->exRegistration->establishment_name }} |
                        {{ $studentRegistration->exRegistration->establishment_type }}</div>

                    <div><span class="font-semibold"> Ancien niveaux :</span>
                        {{ $studentRegistration->exRegistration->classType->alias }}</div>
                @endisset
                <div> <span class="font-semibold"> Inscrit pour :
                    </span> <span class="text-blue-500 underline decoration-blue-500">
                        <a href="{{ route('classrooms.registrations', $studentRegistration->classroom->id) }}">
                            {{ $studentRegistration->classroom->classType->alias }}
                        </a>
                    </span>
                </div>

                <div class="flex space-x-10">

                    @isset($studentRegistration->exRegistration->bultin_1)
                        <div class="flex flex-col">
                            <label for="bultin_1"> Bulletin 1</label>
                            <img src="{{ asset('storage/' . $studentRegistration->exRegistration->bultin_1) }}"
                                alt="" class="w-40 shadow-xl" name="bultin_1">
                        </div>
                    @endisset

                    @isset($studentRegistration->exRegistration->bultin_2)
                        <div class="flex flex-col">
                            <label for="bultin_2"> Bulletin 2</label>
                            <img src="{{ asset('storage/' . $studentRegistration->exRegistration->bultin_2) }}"
                                alt="" class="w-40 shadow-xl" name="bultin_2">
                        </div>
                    @endisset

                    @isset($studentRegistration->exRegistration->bultin_3)
                        <div class="flex flex-col">
                            <label for="bultin_3"> Bulletin 3</label>
                            <img src="{{ asset('storage/' . $studentRegistration->exRegistration->bultin_3) }}"
                                alt="" class="w-40 shadow-xl" name="bultin_3">
                        </div>
                    @endisset

                </div>

            </div>

        </x-cards.inner-card>

        @isset($studentRegistration->student->family->father)
            <x-cards.inner-card class="col-span-2">
                <x-cards.client1 :client-data="$studentRegistration->student->family->father">
                    <x-slot:card_heading> Le père </x-slot:card_heading>

                    <div class="flex items-center">
                        <a href="{{ route('clients.show', ['client' => $studentRegistration->student->family->father->id]) }}"
                            title="Voir" class="btn-nav btn-border-read">
                            <x-icons.eye />
                        </a>

                        <a href="{{ route('clients.edit', ['client' => $studentRegistration->student->family->father->id]) }}"
                            title="Modifier" class="btn-nav btn-border-update">
                            <x-icons.pencil />
                        </a>
                    </div>

                </x-cards.client1>
            </x-cards.inner-card>
        @endisset

        @isset($studentRegistration->student->family->mother)
            <x-cards.inner-card class="col-span-2">
                <x-cards.client1 :client-data="$studentRegistration->student->family->mother">
                    <x-slot:card_heading> La mére </x-slot:card_heading>

                    <div class="flex items-center">
                        <a href="{{ route('clients.show', ['client' => $studentRegistration->student->family->mother->id]) }}"
                            title="Voir" class="btn-nav btn-border-read">
                            <x-icons.eye />
                        </a>

                        <a href="{{ route('clients.edit', ['client' => $studentRegistration->student->family->mother->id]) }}"
                            title="Modifier" class="btn-nav btn-border-update">
                            <x-icons.pencil />
                        </a>
                    </div>

                </x-cards.client1>
            </x-cards.inner-card>
        @endisset



    </div>

</x-app-layout>
