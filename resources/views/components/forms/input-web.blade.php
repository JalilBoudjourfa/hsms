@props(['type', 'name', 'value'])
<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>

    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-1" for="{{ $name }}">
        {{ $label_text ?? '' }}
    </label>

    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name) ?? ($value ?? '') }}"
        class="rounded-lg">

    @error($name)
        <span class="text-red-500"> Veuillez entrer les donnée correctement </span>
    @enderror
</div>
