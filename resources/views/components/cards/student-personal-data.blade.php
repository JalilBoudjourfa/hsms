@props(['student'])

<div {{ $attributes->merge(['class' => 'p-2 rounded-lg']) }}>

    <h3 class="w-full text-xl"> {{ $card_heading ?? '' }} </h3>

    <div class="ml-1 p-1">
        <span class="font-bold"> {{ $student->user->name }} </span>
        (<span class=""> {{ $student->arabic_full_name }} </span>)
    </div>

    <div class="ml-2 p-1">
        <span class="text-gray-700 text-sm font-bold">
            {{ Str::ucfirst($student->sex) }}
        </span>
        né le
        <span class="text-gray-700 text-sm font-mono">
            {{ $student->bday->format('Y-m-d') }}
        </span>
        à
        <span class="text-gray-700 text-sm">
            {{ $student->bplace }} ({{ strtoupper($student->bwilaya) }})
        </span>
    </div>

    <div class="ml-2 p-1">
        Nationalité: <span class="font-bold"> {{ $student->nationality }} </span>
    </div>

    <div class="ml-2 p-1">
        Email: <a href="mailto:{{ $student->user->email }}?subject={{ config('app.CLIENT_NAME') }}"
            class="text-blue-500 font-semibold underline">
            {{ $student->user->email }} </a>
    </div>

    {{ $slot }}

</div>
