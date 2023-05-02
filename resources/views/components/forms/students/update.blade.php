@props(['student'])

<form action={{ route('students.update', ['student' => $student->id]) }} method="post">
    <div class="grid grid-cols-12 gap-4">

        @csrf
        @method('PUT')

        <h3 class="col-span-full text-xl"> {{ $form_heading }} </h3>

        <x-forms.input-for-update name="fname" type="text" required original="{{ $student->user->fname }}"
            class="col-span-6">
            <x-slot:label_text>
                Prénom
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update name="lname" type="text" required original="{{ $student->user->lname }}"
            class="col-span-6">
            <x-slot:label_text>
                Nom
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update name="ar_fname" type="text" required original="{{ $student->ar_fname }}"
            class="col-span-6">
            <x-slot:label_text>
                الاسم
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update name="ar_lname" type="text" required original="{{ $student->ar_lname }}"
            class="col-span-6">
            <x-slot:label_text>
                اللقب
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update name="bday" type="date" required original="{{ $student->bday }}"
            class="col-span-4" min="{{ config('rules.bday.min') }}" max="{{ config('rules.bday.max') }}">
            <x-slot:label_text>
                Date de naissance
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.select-wilaya name="bwilaya" class="col-span-4" selected-wilaya="{{ $student->bwilaya }}" />

        <x-forms.input-for-update name="bplace" type="text" required original="{{ $student->bplace }}"
            class="col-span-4">
            <x-slot:label_text>
                Lieu de naissance
            </x-slot:label_text>
        </x-forms.input-for-update>

        <x-forms.input-for-update name="nationality" type="text" required list="nationalities"
            original="{{ $student->nationality }}" class="col-start-2 col-span-4 justify-self-center">
            <x-slot:label_text>
                Nationalité
            </x-slot:label_text>
        </x-forms.input-for-update>

        <datalist id="nationalities">
            <option value="Algériènne">
        </datalist>

        <div class="col-span-4 justify-self-center mt-2 flex items-center">
            Garcon <input type="radio" name="sex" value="male" @checked('male' === $student->sex) required
                class="mr-2">
            Fille <input type="radio" name="sex" value="female" @checked('female' === $student->sex) required
                class="mr-2">
        </div>

        <x-forms.input-for-update name="email" type="text" original="{{ $student->user->email }}"
            class="col-span-6">
            <x-slot:label_text>
                Email
            </x-slot:label_text>
        </x-forms.input-for-update>

         {{-- <x-forms.select-active-classrooms required class="col-span-2" /> --}}

        <button type="submit" class="col-start-1 btn-action btn-fill-update"> Mettre à jour </button>

    </div>
</form>
