<x-app-layout>

    <x-slot:header>
        {{ __('Liste des élèves') }}
    </x-slot:header>

    @livewire('table-students')

</x-app-layout>
