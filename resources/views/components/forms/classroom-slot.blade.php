@props(['classroom'])

<div class="flex justify-between items-center">

    <input type="hidden" name="classroom[{{ $classroom->id }}]" value="{{ $classroom->id }}">

    <a href="{{ route('classrooms.registrations', ['classroom' => $classroom->id]) }}"
        class="text-blue-900 font-bold underline">
        {{ $classroom->classType->alias }}
    </a>

    <div x-data="{ on: {{ $classroom->active ? 'true' : 'false' }} }" x-on:click="on = !on">
        {{-- <div x-data="{ on: {{ old("state.{$classroom->id}") ?? $classroom->active ? 'true' : 'false' }} }" x-on:click="on = !on"> --}}


        <x-icons2.toggle-on class="w-8 h-8 text-green-400" />
        <x-icons2.toggle-off class="w-8 h-8 text-red-400" />

        <input type="checkbox" name="state[{{ $classroom->id }}]" x-bind:value="on ? 1 : 0" checked="checked"
            class="hidden">

    </div>

</div>

<div class="text-gray-600 text-center font-bold">
    @if ($classroom->rooms_count)
        [
        {{ $classroom->rooms_sum_capacity_min }}
        -
        {{ $classroom->rooms_sum_capacity_max }}
        ]
    @endif
    ({{ $classroom->rooms_count }} {{ Str::plural('salle', $classroom->rooms_count) }})
</div>
<div>
    @foreach ($classroom->rooms as $room)
        <span class="text-gray-600 ml-2 text-xs list-disc"> - {{ $room->name }} </span>
    @endforeach
</div>

<x-validation-error-message name="*.{{ $classroom->id }}" />
