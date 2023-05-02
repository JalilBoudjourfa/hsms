<x-app-layout>

    <x-slot:header>
        {{ $client->user->name }}

        <a href="{{ route('families.board', ['family' => $client->family_id]) }}" title="Voir la famille"
            class="btn-nav btn-fill-read-alt">
            <x-icons.user-group />
        </a>

        <a href="{{ route('clients.show', ['client' => $client->id]) }}" title="Voir" class="btn-nav btn-border-read">
            <x-icons.eye />
        </a>

    </x-slot:header>

    <x-cards.inner-card>

        <x-forms.clients.update :client="$client">
            <x-slot:form_heading>
                Mettre à jour les données du client
            </x-slot:form_heading>
        </x-forms.clients.update>

    </x-cards.inner-card>

</x-app-layout>
