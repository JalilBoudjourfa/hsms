<table>
    <tr>
        <td>
            <img src="logo.png" width="50">
        </td>
        <td>
            <h2> Group Scolaire El Hayat School </h2>
        </td>
    </tr>
</table>

<table class="ml-16">
    <tr>
        <td class="px-4"> Adresse </td>
        <td> Lot A01, section 04 Bir El Djir Oran </td>
    </tr>
    <tr>
        <td class="px-4"> Téléphone </td>
        <td> 041.62.95.99 </td>
    </tr>
</table>

{{--  --}}

<h1 class="text-center mb-0"> Reçu de paiement </h1>

<hr class="my-2">

{{--  --}}

<table class="w-full my-2">
    <tr>
        <td class="py-1 px-0">
            Prénom et nom (élève)
            <b>
                {{ $payment->studentRegistration->student->user->name }}
            </b>
        </td>
        <td class="py-1 px-0">
            Date de naissance
            <b>
                {{ $payment->studentRegistration->student->bday->format('d/m/Y') }}
            </b>
        </td>
    </tr>
    <tr>
        <td class="py-1 px-0">
            Cycle
            <b>
                {{ ucfirst($payment->studentRegistration->classroom->classType->cycle_id) }}
            </b>
        </td>
        <td class="py-1 px-0">
            Niveau
            <b>
                {{ $payment->studentRegistration->classroom->classType->name }}
            </b>
        </td>
    </tr>
</table>

{{--  --}}

<p></p>

<table class="w-full">
    <tr class="bg-gray-100">
        <th class="border py-2"> Date de paiement </th>
        <th class="border py-2"> Désignation </th>
        <th class="border py-2"> Montant </th>
        <th class="border py-2"> Montant en lettre </th>
    </tr>
    <tr>
        <td class="border py-2 px-1 text-center"> {{ $payment->created_at->format('d/m/Y H:i') }} </td>
        <td class="border py-2 px-1 text-center"> {{ ucfirst($payment->expense->name) }} </td>
        <td class="border py-2 px-1 text-center font-mono"> {{ number_format($payment->expense->value, 0, ',', '.') }}
            DA </td>
        {{-- <td class="border py-2 px-1 text-center"> {{ number_format($payment->expense->value, 0) }} </td> --}}
        <td class="border py-2 px-1 text-center font-mono"> {{ strtoupper($payment->expense->spelledValue) }} DINARS
        </td>
    </tr>
</table>

{{--  --}}

<p></p>

{{-- <p>
    Autres frais:
</p>

<table class="w-full">
    <tr>
        <th class="text-left"> Désignation </th>
        <th class="text-left"> À partir de </th>
        <th class="text-left"> Jusqu'à </th>
        <th class="text-left"> Montant </th>
    </tr>
    @foreach ($payment->studentRegistration->classroom->expenses as $expense)
        @continue($expense->id === $payment->expense->id)

        <tr>
            <td class="px-2"> {{ ucfirst($expense->name) }} </td>
            <td class="px-2"> {{ $expense->start_date->isoFormat('DD MMMM YYYY') }} </td>
            <td class="px-2"> {{ $expense->end_date->isoFormat('DD MMMM YYYY') }} </td>
            <td class="px-2 font-mono"> {{ number_format($expense->value, 0, ',', '.') }} DA </td>
        </tr>
    @endforeach
</table> --}}

{{--  --}}

<p>{{ $payment->expense->note }}</p>

<p class="text-right"> Oran, le {{ now()->format('d/m/Y') }} </p>
<p class="text-right"> Gestionnaire </p>

{{-- <div class="mb-52"></div> --}}

<p class="absolute bottom-0"> <i> Il n'y aura pas de remboursement. </i> </p>
