<form action={{ route('students.store') }} method="post" enctype="multipart/form-data">

    @csrf
    {{ $hidden_fields ?? '' }}

    <div class="grid grid-cols-4 items-end gap-2 p-1">

        <h3 class="col-span-4 text-xl"> {{ $form_heading }} </h3>

        <x-forms.input name="fname" bag-name="student" type="text" required class="col-span-2">
            <x-slot:label_text>
                Prénom
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="lname" bag-name="student" type="text" required class="col-span-2">
            <x-slot:label_text>
                Nom
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="ar_fname" bag-name="student" type="text" required class="col-span-2">
            <x-slot:label_text>
                الاسم
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="ar_lname" bag-name="student" type="text" required class="col-span-2">
            <x-slot:label_text>
                اللقب
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="bday" bag-name="student" type="date" min="{{ config('rules.bday.min') }}"
            class="col-span-1" max="{{ config('rules.bday.max') }}" required>
            <x-slot:label_text>
                Date de naissance
            </x-slot:label_text>
        </x-forms.input>

        {{-- <x-forms.select-wilaya name="bwilaya" class="col-span-1" required /> --}}
        {{-- <x-forms.input name="bwilaya" bag-name="student" type="text" required class="col-span-2">
            <x-slot:label_text>
                Lieu de naissance
            </x-slot:label_text>
        </x-forms.input> --}}

        <x-forms.input name="bplace" bag-name="student" type="text" required class="col-span-3">
            <x-slot:label_text>
                Lieu de naissance
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="nationality" bag-name="student" type="text" required list="nationalities"
            class="col-span-2">
            <x-slot:label_text>
                Nationalité
            </x-slot:label_text>
        </x-forms.input>

        <datalist id="nationalities">
            <option value="Algériènne">
        </datalist>

        <div class="col-span-2 mt-2 flex items-center">
            Garcon <input type="radio" name="sex" value="male" required class="mr-2">
            Fille <input type="radio" name="sex" value="female" required class="mr-2">
        </div>

        <hr class="bg-gray-500 col-span-4 h-1 m-2 rounded-xl">

        <h4 class="col-span-4 ml-4 text-lg"> Inscription: </h4>

        <x-forms.select-active-classrooms required class="col-span-2" />
        {{-- PRINT ERROR MSG --}}

        <x-forms.input name="deposition_date" bag-name="student" type="date"
            min="{{ config('rules.deposition_date.min') }}" max="{{ config('rules.deposition_date.max') }}" required
            class="col-span-2">
            <x-slot:label_text>
                Date de déposition
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="establishment_name" bag-name="student" type="text" class="col-span-2">
            <x-slot:label_text>
                L'ancien établissement
            </x-slot:label_text>
        </x-forms.input>

        <x-forms.input name="ex_est_wilaya" bag-name="student" type="text" class="col-span-2">
            <x-slot:label_text>
               Lieu ancien établissement
            </x-slot:label_text>
        </x-forms.input>

        <div class="col-span-1 mt-2 flex items-center">
            Privé <input type="radio" name="establishment_type" value="privet" required class="mr-2">
            Public <input type="radio" name="establishment_type" value="public" required class="mr-2">
        </div>

        <div class="col-span-2">
            <select name="ex_registration_class_type_id"
                class="bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 w-full rounded-md">
                <option disabled selected value> -- L'ancienne classe -- </option>

                @foreach ($class_types as $class_type)
                    <option value="{{ $class_type->id }}">{{ $class_type->name }}</option>
                @endforeach

            </select>

            <x-validation-error-message name="ex_registration_class_type_id" bag-name="student" />

        </div>

        <div class="col-span-4 p-2 flex justify-between items-center">
            <p> Les moyennes trimestrielles [1,2,3] </p>
            <input type="number" name="grade_1" value="{{ old('grade_1') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
            <input type="number" name="grade_2" value="{{ old('grade_2') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
            <input type="number" name="grade_3" value="{{ old('grade_3') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
        </div>

        <x-validation-error-message name="grade_1" bag-name="student" />
        <x-validation-error-message name="grade_2" bag-name="student" />
        <x-validation-error-message name="grade_3" bag-name="student" />

        <div class="grid grid-cols-1 space-y-5 p-2 col-span-4">
            <p> Les Bultin trimestrielles [1,2,3] </p>
            <input type="file" name="bultin_1" class="ml-2 rounded-md">
            <input type="file" name="bultin_2" value="{{ old('bultin_2') }}" min="0" max="20"
                step="0.01" class="ml-2 rounded-md">
            <input type="file" name="bultin_3" value="{{ old('bultin_3') }}" min="0" max="20"
                step="0.01" class="ml-2 rounded-md">
        </div>

        <x-validation-error-message name="bultin_1" bag-name="student" />
        <x-validation-error-message name="bultin_2" bag-name="student" />
        <x-validation-error-message name="bultin_3" bag-name="student" />

        <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>

    </div>

</form>
