@props(['name', 'bagName' => 'default'])

@error($name, $bagName)
    <div {{ $attributes->merge(['class' => 'text-red-500 mt-2 text-sm']) }}>
        {{ $message }}
    </div>
@enderror
