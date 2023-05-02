<x-app-layout>

    <x-slot:header>

        {{-- ! Costs 2 queries --}}
        {{ $payment->studentRegistration->classroom->establishmentYear->year_id }}
        :
        {{ $payment->expense->name }}
        pour
        {{ $payment->studentRegistration->student->user->name }}

        <a href="{{ route('students.board', ['student' => $payment->studentRegistration->student->id]) }}" title=""
            class="btn-nav btn-fill-read-alt">

            <x-icons.user />
        </a>

    </x-slot:header>

    <x-cards.inner-card class="p-4 bg-white">

        <form action="{{ route('payments.update', ['payment' => $payment->id]) }}" method="post">

            @csrf
            @method('PATCH')

            <div class="grid grid-cols-4 items-end gap-2 p-1">

                <x-forms.input name="paid" type="number" value="{{ $payment->paid }}" min="0"
                    max="{{ $payment->expense->reducedValue($payment->reduction) }}" required class="col-span-2">
                    <x-slot:label_text>
                        Payé:
                        <span class="font-mono">
                            {{ number_format($payment->paid, 2) }}
                            /
                            {{ number_format($payment->expense->value, 2) }}
                            DZD
                        </span>
                    </x-slot:label_text>
                </x-forms.input>

                <div class="col-start-1 col-span-full mt-2 flex items-center">
                    Paie par facilté ?
                    <div x-data="{ on: {{ $payment->ez_mode ? 'true' : 'false' }} }" x-on:click="on = !on">

                        <x-icons2.toggle-on class="w-8 h-8 text-green-400" />
                        <x-icons2.toggle-off class="w-8 h-8 text-red-400" />

                        <input type="checkbox" name="ez_mode" x-bind:value="on ? 1 : 0" checked="checked"
                            class="hidden">
                    </div>
                </div>

                <x-forms.input name="reduction" value="{{ $payment->reduction }}" type="number" min="0"
                    max="{{ $payment->expense->value }}" class="col-start-1 col-span-2">
                    <x-slot:label_text>
                        Réduction:
                        <span class="font-mono">
                            {{ number_format($payment->reduction, 2) }} DZD
                        </span>
                    </x-slot:label_text>
                </x-forms.input>

                <button class="btn-action-w btn-fill-update col-start-1"> Modifier le payment </button>

            </div>

        </form>

    </x-cards.inner-card>

</x-app-layout>
