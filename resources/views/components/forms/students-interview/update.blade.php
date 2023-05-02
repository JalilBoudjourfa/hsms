@props(['interview'])

<form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }} method="post">

    @csrf

    <div class="grid grid-cols-4 items-end gap-2 p-1">

        <h3 class="col-span-4 text-xl"> Fixer un entretien </h3>

        <x-forms.input name="title" type="text" class="col-span-full">
            <x-slot:label_text>
                Titre
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="schedule" type="datetime-local" required class="col-span-2">
            <x-slot:label_text>
                Rendez-vous
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="interrogators" type="text" required class="col-span-2">
            <x-slot:label_text>
                Intérogateur
            </x-slot:label_text>
        </x-forms.input>

        <label for="participants"> Participants: </label>
        <div class="col-span-full mt flex items-center justify-center">
            Père <input type="radio" name="participants" value="père" required class="mr-2">
            Mère <input type="radio" name="participants" value="mère" required class="mr-2">
            Parents <input type="radio" name="participants" value="parents" required class="mr-2">
            autre <input type="radio" name="participants" value="autre" required class="mr-2">
        </div>
        <x-validation-error-message name="participants" />

        <textarea name="note" cols="30" rows="3"
            class="col-span-full resize-none appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none p-2 rounded leading-tight"></textarea>

        <button type="submit" class="btn-action btn-border-update-alt"> Mèttre à jour </button>

    </div>
</form>
