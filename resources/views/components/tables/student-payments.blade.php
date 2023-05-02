@props(['student'])

<h3 class="col-span-4 text-lg text-blue-500"> Suivi des paiements: </h3>

<table class="border-2 m-4">
    <tr class="bg-blue-50 text-black">
        <th class="border p-1">
            ...
        </th>

        <th class="border p-1">
            Montant
        </th>

        <th class="border p-1">
            L'état du paiement
        </th>

        <th class="border p-1">
            Par facilité
        </th>

        <th class="border p-1">
            Réduction
        </th>

        <th class="border p-1"></th>

        <th class="border p-1"></th>
    </tr>
    @foreach ($student->latestRegistration->classroom->expenses as $expense)

        <tr>

            <td class="border p-1">
                <a href="{{ route('expenses.edit', ['expense' => $expense->id]) }}"
                    class="text-blue-500 font-semibold underline">
                    {{ $expense->name }}
                </a>
            </td>

            <td class="border p-1 font-mono">
                {{ number_format($expense->value, 2) }} DZD
            </td>

            @php
                $payment = $student->latestRegistration->payments->where('expense_id', $expense->id)->first();
                $paid = boolval($student->latestRegistration->payments->where('expense_id', $expense->id)->count());
            @endphp

            <td class="border p-1 font-semibold">
                @if ($paid)
                    @if ($payment->paid / $expense->reducedValue($payment->reduction) === 1)
                        Finalisé
                    @else
                        <span class="font-mono">
                            {{ number_format($payment->paid, 2) }}/{{ number_format($expense->reducedValue($payment->reduction), 2) }}
                            DZD
                        </span>
                    @endif
                @else
                    -
                @endif
            </td>

            <td class="border p-1">
                {{ $payment?->ez_mode ? 'OUI' : 'NON' }}
            </td>

            <td class="border p-1 font-mono">
                {{ number_format($payment?->reduction, 2) }} DZD
            </td>

            <td class="border p-1 underline">
                @if ($paid)
                    <a href="{{ route('payments.edit', ['payment' => $payment->id]) }}"> modifier </a>
                @else
                    <a href="{{ route('payments.create', ['reg' => $student->latestRegistration->id, 'expense' => $expense->id]) }}"
                        class="underline">
                        Procéder au payment
                    </a>
                @endif
            </td>

            <td class="border p-1 underline">
                @if ($paid)
                    <a href="{{ route('payments.receipt', ['payment' => $payment->id]) }}" target="_blank"> recu de
                        paiement </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
