<x-app-layout>

    <x-slot:header>
        {{ __('Ajouter une nouvelle famille') }}
    </x-slot:header>

    <div class="grid grid-cols-12 grid-rows-2 gap-4">

        <x-cards.inner-card class="col-span-full md:col-span-6 bg-white">
            {{-- FATHER --}}

            <x-forms.clients.create action="{{ route('families.store') }}" bag="father">
                <x-slot:hidden_fields>
                    <input type="hidden" name="family_title" value="father">
                </x-slot:hidden_fields>

                <x-slot:form_heading>
                    Ajouter le père
                </x-slot:form_heading>
            </x-forms.clients.create>

        </x-cards.inner-card>

        <x-cards.inner-card class="col-span-full md:col-span-6 row-span-1 bg-white">
            {{-- MOTHER --}}

            <x-forms.clients.create action="{{ route('families.store') }}" bag="mother">
                <x-slot:hidden_fields>
                    <input type="hidden" name="family_title" value="mother">
                </x-slot:hidden_fields>

                <x-slot:form_heading>
                    Ajouter la mère
                </x-slot:form_heading>
            </x-forms.clients.create>

        </x-cards.inner-card>

        <div class="col-start-2 col-span-10 row-span-1 bg-white rounded-full grid place-content-center">
            <div> Les enfants/élèves </div>
        </div>

</x-app-layout>
