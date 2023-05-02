<x-app-layout>

    <x-slot:header>
        {{ $student->user->name }}


            <a href="{{ route('families.board', ['family' => $student->family_id]) }}" title="Voir la famille"
                class="btn-nav btn-fill-read-alt">

                <x-icons.user-group />
            </a>

            <a href="{{ route('students.board', ['student' => $student->id]) }}" title="Voir"
                class="btn-nav btn-fill-read">

                <x-icons.eye />
            </a>


    </x-slot:header>

    <x-cards.inner-card>

        <x-forms.students.update :student="$student">
            <x-slot:form_heading>
                Mettre à jour les données de l'élève
            </x-slot:form_heading>
        </x-forms.students.update>

    </x-cards.inner-card>

</x-app-layout>
