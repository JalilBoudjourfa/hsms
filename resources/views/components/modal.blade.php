@props(['openningEvent'])

<section x-data="{ visible: false }" x-show="visible" x-transition x-on:keyup.escape.window="visible = false"
    x-on:{{ $openningEvent }}.window="visible = true"
    class="absolute top-0 left-0 right-0 bottom-0 z-20 bg-gray-overlay overflow-auto">

    <div class="flex justify-center items-center container h-full mx-auto p-4 lg:p-16">

        <div x-on:click.outside="visible = false" {{ $attributes->merge(['class' => 'p-6 bg-white']) }}>

            {{ $slot }}

        </div>
    </div>
</section>
