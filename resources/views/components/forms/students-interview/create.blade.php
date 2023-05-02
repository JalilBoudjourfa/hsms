@props(['regId'])

<form action={{ route('student-interviews.store') }} method="post">

    @csrf
    <input type="hidden" name="student_registration_id" value="{{ $regId }}">

    <div class="grid grid-cols-4 items-end gap-2 p-1">

        <h3 class="col-span-4 text-lg text-blue-500"> Fixer un entretien </h3>

        <select name="type" id="type" class="col-span-full">
            <option value="" selected disabled>Type du rendez vous</option>
            <option value="registrationn">Inscription</option>
            <option value="payment">Paiment</option>
        </select>

        <x-forms.input name="title" bag-name="student_interview" type="text" class="col-span-full">
            <x-slot:label_text>
                Titre
            </x-slot:label_text>
        </x-forms.input>


        <x-forms.input name="schedule" bag-name="student_interview" type="datetime-local" required class="col-span-2">
            <x-slot:label_text>
                Rendez-vous
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="interrogators" bag-name="student_interview" type="text" required class="col-span-2">
            <x-slot:label_text>
                Intérogateur
            </x-slot:label_text>
        </x-forms.input>

        <label for="participants"> Participants: </label>
        <div class="col-span-full mt flex items-center justify-center">
            Père <input type="checkbox" name="father" value="1" class="mr-2">
            Mère <input type="checkbox" name="mother" value="1" class="mr-2">
        </div>
        <x-validation-error-message name="participants" bag-name="student_interview" />

        <textarea name="note" cols="30" rows="3"
            class="col-span-full resize-none appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none p-2 rounded leading-tight"></textarea>
        <x-validation-error-message class="col-span-full" name="note" bag-name="student_interview" />

        <button type="submit" class="btn-action btn-border-create-alt"> Ajouter </button>

    </div>
</form>
