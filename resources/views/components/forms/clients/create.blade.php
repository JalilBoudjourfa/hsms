@props(['action', 'bag' => 'default'])

<form action="{{ $action }}" method="post">

    @csrf
    {{ $hidden_fields ?? '' }}

    <div class="grid grid-cols-4 gap-2 mb-3 p-1">

        <h3 class="col-span-4 text-xl"> {{ $form_heading }} </h3>

        <x-forms.input type="text" name="fname" bag-name="{{ $bag }}" required class="col-span-2">
            <x-slot:label_text>
                Prénom
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="text" name="lname" bag-name="{{ $bag }}" required class="col-span-2">
            <x-slot:label_text>
                Nom
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="text" name="email" bag-name="{{ $bag }}" class="col-span-2">
            <x-slot:label_text>
                E-mail
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="tel" name="number" bag-name="{{ $bag }}" class="col-span-2">
            <x-slot:label_text>
                Téléphone
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="tel" name="home_num" bag-name="{{ $bag }}" class="col-span-2">
            <x-slot:label_text>
                Téléphone Domicile
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="tel" name="whatsapp" bag-name="{{ $bag }}" class="col-span-2">
            <x-slot:label_text>
                Whatsapp
            </x-slot:label_text>
        </x-forms.input>


        {{-- <x-forms.input type="text" name="cni" bag-name="{{$bag}}" class="col-span-2">
        <x-slot:label_text>
            Numéro de la carte nationale
        </x-slot:label_text>
    </x-forms.input> --}}

        <x-forms.input type="text" name="address" bag-name="{{ $bag }}" required class="col-span-2">
            >
            <x-slot:label_text>
                Adresse
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input type="phone" name="profession" bag-name="{{ $bag }}" required class="col-span-2">
            <x-slot:label_text>
                Profession
            </x-slot:label_text>
        </x-forms.input>

        <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>

    </div>

</form>
