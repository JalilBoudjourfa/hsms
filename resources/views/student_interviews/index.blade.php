<x-app-layout>

    <x-slot:header>
        <div class="mr-4">
            Entretiens d'élèves
        </div>

        <a href="{{ '' }}" title="" class="btn-nav">
            {{-- <x-icons.user /> --}}
        </a>

    </x-slot:header>

    @livewire('table-interviews')

</x-app-layout>
