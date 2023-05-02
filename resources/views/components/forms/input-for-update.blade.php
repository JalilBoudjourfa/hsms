@props(['type', 'name', 'original', 'class' => ''])

<div class='flex flex-col {{ $class }}' updateInputContainer>

    {{-- LABEL --}}
    <label class="blocktext-gray-700 mb-1 text-xs font-bold" for="{{ $name }}">
        {{ $label_text }}
        <img src="{{ asset('svg/x-circle.svg') }}" alt="" class="inline-block h-4 w-4 cursor-pointer hidden" reset
            onclick="resetInputOriginalValue(event)">

    </label>

    {{-- INPUT --}}
    <input name="{{ $name }}" type="{{ $type ?? 'text' }}" value="{{ old($name, $original) }}"
        {{ $attributes }}
        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 p-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        oninput="updatedInput(event)" data-original="{{ $original ?? '' }}">

    <x-validation-error-message name="{{ $name }}" />

</div>
