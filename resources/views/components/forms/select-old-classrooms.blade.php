<div>
    <select name="ex_registration_class_type_id"
        {{ $attributes->merge(['class' => 'bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 py-2 rounded-md']) }}
        {{ $attributes }}>

        <option disabled selected value> -- Séléctionnez l'encien niveau -- </option>

        @foreach ($class_types as $class_type)
            <option value="{{ $class_type->id }}"> {{ $class_type->name }} </option>
        @endforeach


    </select>

    @error('class_type_id')
        {{ $message }}
    @enderror

</div>
