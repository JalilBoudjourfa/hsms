@props(['type', 'name'])

<div class="px-3 mt-3">

    {{-- INPUT --}}
    <input name="{{ $name }}" type="{{ $type ?? 'text' }}" value="{{ old($name) }}" {{ $attributes }}
        class="appearance-none bg-gray-100 text-gray-700 border border-gray-200 p-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

    <x-validation-error-message name="{{ $name }}" />

</div>
