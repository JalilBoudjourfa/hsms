@props(['client'])

<form action={{ route('clients.update', ['client' => $client->id]) }} method="post">
    <div class="grid grid-cols-12 gap-4">

        @csrf
        @method('PUT')

        <h3 class="col-span-full text-xl"> {{ $form_heading }} </h3>

        <x-forms.input-for-update type="text" name="fname" original="{{ $client->user->fname }}"
            class="col-span-6">
            <x-slot:label_text>
                Prénom
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update type="text" name="lname" original="{{ $client->user->lname }}"
            class="col-span-6">
            <x-slot:label_text>
                Nom
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update type="text" name="email" original="{{ $client->user->email }}"
            class="col-span-6">
            <x-slot:label_text>
                E-mail
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update type="tel" name="number" original="{{ $client->user->primaryPhone?->number }}"
            class="col-span-6">
            <x-slot:label_text>
                Téléphone
            </x-slot:label_text>
        </x-forms.input-for-update>

        {{-- <x-forms.input-for-update type="text" name="cni" maxlength="20" original="{{ $client->cni }}" class="col-span-6">
        <x-slot:label_text>
            Numéro de la carte nationale
        </x-slot:label_text>
    </x-forms.input-for-update> --}}

        <x-forms.input-for-update type="text" name="address" original="{{ $client->address }}" class="col-span-6">

            <x-slot:label_text>
                Adresse
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update type="text" name="profession" maxlength="32" original="{{ $client->profession }}"
            class="col-span-6">
            <x-slot:label_text>
                Profession
            </x-slot:label_text>
        </x-forms.input-for-update>

        <button type="submit" class="col-start-1 btn-action btn-fill-update"> Mettre à jour </button>

    </div>

</form>
