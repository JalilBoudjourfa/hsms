<x-app-layout>

    <x-slot:header>
        Les frais

        <div class="flex">

            <a href="{{ route('expense-types.create') }}" title="Ajouter un type de frais"
                class="btn-nav btn-border-create">
                Ajouter un type de frais
            </a>

            <a href="{{ route('expenses.create', ['year' => $year_id]) }}" title="Ajouter un frais à l'année"
                class="btn-nav btn-border-create">
                Ajouter un frais à l'année
            </a>

        </div>
    </x-slot:header>

    <a href="{{ route('expenses.index', ['year' => $year_id]) }}" class="text-green-700 text-2xl peer font-bold">
        {{ $year_id }} </a>

    <ul class="w-fit absolute hidden peer-hover:block hover:block rounded-xl bg-white shadow-md  px-8 py-2">
        @foreach ($years as $year)
            <a href="{{ route('expenses.index', ['year' => $year]) }}" class="text-green-700 text-2xl font-bold">
                {{ $year }} </a>
            •
        @endforeach
    </ul>

    @livewire('table-expenses', ['year_id' => $year_id])

</x-app-layout>
