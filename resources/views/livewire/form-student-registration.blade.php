<div>
    <form wire:submit.prevent="store">

        <input wire:model="deposition_date" bag-name="student" type="date"
            min="{{ config('rules.deposition_date.min') }}" max="{{ config('rules.deposition_date.max') }}" required
            class="col-span-2">


        <input wire:model="establishment_name" bag-name="student" type="text" class="col-span-2">

        <input wire:model="ex_est_wilaya" bag-name="student" type="text" class="col-span-2">

        <div class="col-span-1 mt-2 flex items-center">
            Privé <input type="radio" name="establishment_type" value="privet" required class="mr-2">
            Public <input type="radio" name="establishment_type" value="public" required class="mr-2">
        </div>

        <div class="col-span-2">
            <select wire:model="ex_registration_class_type_id"
                class="bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 w-full rounded-md">
                <option disabled selected value> -- L'ancienne classe -- </option>

                @foreach ($class_types as $class_type)
                    <option value="{{ $class_type->id }}">{{ $class_type->name }}</option>
                @endforeach

            </select>

            <x-validation-error-message name="ex_registration_class_type_id" bag-name="student" />

        </div>

        <x-forms.select-active-classrooms required class="col-span-2" />

        <div class="col-span-4 p-2 flex justify-between items-center">
            <p> Les moyennes trimestrielles [1,2,3] </p>
            <input type="number" wire:model="grade_1" value="{{ old('grade_1') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
            <input type="number" wire:model="grade_2" value="{{ old('grade_2') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
            <input type="number" wire:model="grade_3" value="{{ old('grade_3') }}" min="0" max="20"
                step="0.01" class="w-24 ml-2 rounded-md">
        </div>

        <x-validation-error-message name="grade_1" bag-name="student" />
        <x-validation-error-message name="grade_2" bag-name="student" />
        <x-validation-error-message name="grade_3" bag-name="student" />

        <div class="grid grid-cols-1 space-y-5 p-2 col-span-4">
            <p> Les Bultin trimestrielles [1,2,3] </p>
            <input type="file" wire:model="bultin_1" class="ml-2 rounded-md">
            <input type="file" wire:model="bultin_2" value="{{ old('bultin_2') }}" min="0"
                max="20" step="0.01" class="ml-2 rounded-md">
            <input type="file" wire:model="bultin_3" value="{{ old('bultin_3') }}" min="0"
                max="20" step="0.01" class="ml-2 rounded-md">
        </div>

        <x-validation-error-message name="bultin_1" bag-name="student" />
        <x-validation-error-message name="bultin_2" bag-name="student" />
        <x-validation-error-message name="bultin_3" bag-name="student" />

        <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>

    </form>
</div>
