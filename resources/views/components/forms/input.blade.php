@props(['type', 'name', 'value', 'bagName' => 'default', 'class'])

<div class="{{ $class ?? '' }}">

    {{-- LABEL --}}
    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-1 " for="{{ $name }}">
        {{ $label_text ?? '' }}
    </label>

    {{-- INPUT --}}
    <input name="{{ $name }}" type="{{ $type }}" value="{{ old($name) ?? ($value ?? '') }}"
        {{ $attributes }}
        class="appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none w-full p-2 rounded leading-tight">

    <x-validation-error-message name="{{ $name }}" bag-name="{{ $bagName }}" />

</div>
