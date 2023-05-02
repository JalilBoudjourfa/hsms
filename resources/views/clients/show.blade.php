<x-app-layout>

    <x-slot:header>
        {{ $client->user->name }}

        <a href="{{ route('families.board', ['family' => $client->family_id]) }}" title="Voir la famille"
            class="btn-nav btn-fill-read-alt">
            <x-icons.user-group />
        </a>

        <a href="{{ route('clients.edit', ['client' => $client->id]) }}" title="Modifier"
            class="btn-nav btn-border-update">
            <x-icons.pencil />
        </a>
    </x-slot:header>

    <x-cards.client1 :client-data="$client" class="bg-white w-1/2 py-2 px-4 m-4 shadow-inner rounded-lg">
        <x-slot:card_heading> </x-slot:card_heading>
    </x-cards.client1>

</x-app-layout>
