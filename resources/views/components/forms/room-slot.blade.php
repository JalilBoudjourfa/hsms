@props(['room', 'activeClassrooms'])

<div class="flex justify-between items-end">

    {{-- TRUE ROOM ID --}}
    <input type="hidden" name="room[{{ $room->id }}]" value="{{ $room->id }}">

    {{-- CARD DATA --}}
    <div class="">
        <div class="font-bold"> {{ $room->name }} </div>

        <div class="text-blue-900 font-semibold underline">
            @if ($room->classroom)
                <a href="{{ route('classrooms.registrations', ['classroom' => $room->classroom->id]) }}">
                    {{ $room->classroom->classType->alias }}
                </a>
            @endif
        </div>

        <div class="text-xs"> {{ $room->updated_at }} </div>
    </div>

    {{-- CAPACITY MIN --}}
    <div class="p-1 flex flex-col items-center">
        <label for="capacity_min[{{ $room->id }}]"> Min </label>
        <input type="number" name="capacity_min[{{ $room->id }}]" min="0" class="w-20 ml-1 p-1 rounded-md"
            required value="{{ old("capacity_min.$room->id", $room->capacity_min) }}">
    </div>

    {{-- CAPACITY MAX --}}
    <div class="p-1 flex flex-col items-center">
        <label for="capacity_max[{{ $room->id }}]"> Max </label>
        <input type="number" name="capacity_max[{{ $room->id }}]" min="0" class="w-20 ml-1 p-1 rounded-md"
            required value="{{ old("capacity_max.$room->id", $room->capacity_max) }}">
    </div>

    {{-- ACTIVE CLASSOOMS IDs --}}
    <select name="classroom[{{ $room->id }}]"
        class="bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 w-48 h-11 m-1 p-1 pr-4 text-base truncate rounded-md"
        required>

        <option value="0"> - </option>

        @foreach ($activeClassrooms as $year => $classroom)
            <option value="{{ $classroom->id }}" @selected($room->classroom?->id === $classroom->id)>
                {{ $classroom->classType->name }}
            </option>
        @endforeach

    </select>

</div>
<x-validation-error-message name="*.{{ $room->id }}" />
