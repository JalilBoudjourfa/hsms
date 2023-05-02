<x-app-layout>

    <x-slot:header>
        Ajouter un type de frais
    </x-slot:header>

    <x-cards.inner-card class="col-span-full bg-white">
        <form action="{{ route('expense-types.store') }}" method="post">

            @csrf

            <div class="flex flex-col gap-1">

                <x-forms.input name="name" type="text" required>
                    <x-slot:label_text>
                        Nom
                    </x-slot:label_text>
                </x-forms.input>

                <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>
            </div>

        </form>
    </x-cards.inner-card>

</x-app-layout>
