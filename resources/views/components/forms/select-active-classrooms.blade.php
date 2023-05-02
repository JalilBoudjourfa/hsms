<select name="classroom_id" wire:model.defer="classroom_id"
    {{ $attributes->merge(['class' => 'bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 py-2 rounded-md']) }}
    {{ $attributes }}>

    <option disabled selected value> -- Séléctionnez une classe -- </option>

    @isset($active_classrooms)
        {{--  --}}
        @foreach ($active_classrooms as $grouping_key => $classrooms)
            {{--  --}}
            <optgroup label="{{ $grouping_key }}">

                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"> {{ $classroom->name }} </option>
                @endforeach

            </optgroup>
            {{--  --}}
        @endforeach
        {{--  --}}
    @endisset

</select>

<x-validation-error-message name="classroom_id" />
