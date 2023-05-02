<x-app-layout>

    <x-slot:header>
        {{ $reg->classroom->establishmentYear->year_id }}
        :
        {{ $expense->name }}
        pour
        {{ $reg->student->user->name }}

        <a href="{{ route('students.board', ['student' => $reg->student->id]) }}" title="voir l'élève"
            class="btn-nav btn-fill-read">
            <x-icons.user />
        </a>
    </x-slot:header>

    <x-cards.inner-card class="p-4 flex flex-col gap-y-4 bg-white">

        <form action={{ route('payments.store', ['reg' => $reg->id, 'expense' => $expense->id]) }} method="post">

            @csrf

            <div class="grid grid-cols-4 items-end gap-2 p-1">

                <x-forms.input name="paid" type="number" min="0" max="{{ $expense->value }}" required
                    class="col-span-2">
                    <x-slot:label_text>
                        Montant: / {{ number_format($expense->value, 2) }} DZD
                    </x-slot:label_text>
                </x-forms.input>

                <div class="col-start-1 col-span-full mt-2 flex items-center">
                    Paie par facilté ?
                    <div x-data="{ on: false }" x-on:click="on = !on">

                        <x-icons2.toggle-on class="w-8 h-8 text-green-400" />
                        <x-icons2.toggle-off class="w-8 h-8 text-red-400" />

                        <input type="checkbox" name="ez_mode" x-bind:value="on ? 1 : 0" checked="checked"
                            class="hidden">
                    </div>
                </div>

                <x-forms.input name="reduction" value="0" type="number" min="0" max="{{ $expense->value }}"
                    class="col-start-1 col-span-2">
                    <x-slot:label_text>
                        Réduction:
                    </x-slot:label_text>
                </x-forms.input>

                <button class="btn-action-w btn-fill-create col-start-1"> Confirmer le payment </button>

            </div>
        </form>

    </x-cards.inner-card>


</x-app-layout>
