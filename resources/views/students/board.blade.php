<x-app-layout>

    <x-slot:header>
        {{ $student->user->name }}

        <a href="{{ route('families.board', ['family' => $student->family_id]) }}" title="Voir la famille"
            class="btn-nav btn-fill-read-alt">
            <x-icons.user-group />
        </a>

        <a href="{{ route('students.edit', ['student' => $student->id]) }}" title="Modifier"
            class="btn-nav btn-border-update">
            <x-icons.pencil />
        </a>
    </x-slot:header>

    <div class="grid grid-cols-12 gap-4">

        <x-cards.inner-card class="col-span-full lg:col-span-8">
            <x-cards.student-personal-data :student="$student" class="bg-white rounded-lg">
                <x-slot:card_heading> </x-slot:card_heading>
            </x-cards.student-personal-data>
        </x-cards.inner-card>

        {{--  --}}

        <x-cards.inner-card class="col-span-full p-2 lg:col-span-4 lg:row-span-3">
            <x-cards.student-comments :student="$student" class="h-full" />
        </x-cards.inner-card>

        {{--  --}}

        <x-cards.inner-card class="col-span-full lg:col-span-8">
            <h3 class="text-lg text-blue-500"> Historique des inscrptions: </h3>

            @livewire('table-student-registrations-history', ['studentId' => $student->id])

            {{-- <section class="col-span-full my-5">
                <button x-data x-on:click="$dispatch('open-add-student-registration-modal')"
                    class="place-self-center py-2 px-4 border btn-border-create rounded-full">
                    Ajouter une nouvelle inscription
                </button>

                <x-modal openning-event='open-add-student-registration-modal'
                    class="col-span-10 col-start-2 justify-self-center rounded-lg md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4">
                    @livewire('form-student-registration', ['student' => $student])
                </x-modal>

            </section> --}}
        </x-cards.inner-card>

        {{--  --}}

        <section class="col-span-12 text-lg text-center bg-blue-600 text-white rounded-t-md rounded-b-2xl">
            Dernière inscription
            <span class="font-bold">
                {{ $student->latestRegistration->classroom->classType->name }}
            </span>
            pour
            <span class="font-bold">
                {{ $student->latestRegistration->classroom->establishmentYear->composed_key }}
            </span>
        </section>

        {{--  --}}

        <section class="col-span-full">
            <button x-data x-on:click="$dispatch('open-add-student-interview-modal')"
                class="place-self-center py-2 px-4 border btn-border-create rounded-full">
                <x-icons2.calendar class="w-8 h-8 inline" />
                Donner un rendez vous d'entretien
            </button>
        </section>

        {{--  --}}

        <x-modal openning-event='open-add-student-interview-modal'
            class="col-span-10 col-start-2 justify-self-center rounded-lg md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4">
            <x-forms.students-interview.create :reg-id="$student->latestRegistration->id" />
        </x-modal>

        @if ($errors->hasBag('student_interview'))
            <i x-data x-init="$dispatch('open-add-student-interview-modal')"></i>
        @endif

        {{--  --}}

        <x-cards.inner-card class="col-span-full flex justify-between items-center">

            <div class="text-white bg-blue-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <polyline points="15 6 9 12 15 18"></polyline>
                </svg>
            </div>

            <div class="h-full p-2 flex flex-row flex-1 space-x-5 overflow-x-auto snap-x">

                @foreach ($student->latestRegistration->studentInterviews->sortByDesc('schedule') as $interview)
                    <x-cards.student-interview :interview="$interview"
                        class="w-[250px] sm:w-[300px] flex-shrink-0 bg-white border-gray-200
                        snap-center border-2">
                    </x-cards.student-interview>
                @endforeach

            </div>

            <div class="text-white bg-blue-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <polyline points="9 6 15 12 9 18"></polyline>
                </svg>
            </div>

        </x-cards.inner-card>

        {{--  --}}

        <x-cards.inner-card
            class="col-span-12 border flex flex-wrap justify-center gap-4 py-2 px-4 border-dotted border-orange-300 rounded-md">

            <div class="flex gap-4">

                <form action="{{ route('send_email.payment') }}" method="post" class="inline-block">
                    @csrf
                    <input type="hidden" name="student_registration_id" value="{{ $student->latestRegistration->id }}">

                    <button class="btn-action-w inline-block bg-slate-700 text-white border-slate-700">
                        Notifier pour le paiement
                    </button>
                </form>

                <button class="btn-action-w inline-block">
                    Notifier l'état de l'inscription
                </button>
            </div>

            <div class="flex gap-4">
                <form action="{{ route('student-registrations.update', $student->latestRegistration) }}" method="post"
                    class="inline-block">
                    @csrf
                    @method('PUT')
                    <button name="action" value="accept" class="btn-action-w inline-block">
                        Accepter l'élèves
                    </button>
                    <button name="action" value="reject" class="btn-action-w inline-block">
                        Rejeter l'inscription
                    </button>

                    <button name="action" value="wait" class="btn-action-w inline-block">
                        Mettre en attente
                    </button>
                </form>
            </div>

        </x-cards.inner-card>

        {{--  --}}

        <x-cards.inner-card class="col-span-full">

            <x-tables.student-payments :student="$student" />

        </x-cards.inner-card>

    </div>

</x-app-layout>
