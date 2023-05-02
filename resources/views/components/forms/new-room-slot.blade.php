@props(['establishmentYear', 'activeClassrooms'])
<div class="bg-white w-full m-1 mb-10 p-2 rounded-md border border-gray-800 border-dashed">

    <form action={{ route('rooms.store') }} method="post">

        <div class="flex items-center">

            @csrf
            {{-- EstablishmentYear --}}
            <input type="hidden" name="year_id" value="{{ $establishmentYear->year_id }}">
            <input type="hidden" name="establishment_id" value="{{ $establishmentYear->establishment_id }}">

            {{-- LABEL --}}
            <div class="py-2 px-3 flex items-center">
                <label for="name"> Nom de la salle </label>
                <input type="text" name="name" value="{{ old('name') }}" value="{{ old('name') }}"
                    class="ml-2 rounded-md" required>
            </div>

            {{-- CAPACITY MIN --}}
            <div class="py-2 px-3 flex items-center">
                <label for="capacity_min"> Min </label>
                <input type="number" name="capacity_min" value="{{ old('capacity_min') }}" min="0"
                    class="w-20 ml-2 rounded-md" required>
            </div>

            {{-- CAPACITY MAX --}}
            <div class="py-2 px-3 flex items-center">
                <label for="capacity_max"> Max </label>
                <input type="number" name="capacity_max" value="{{ old('capacity_max') }}" min="0"
                    class="w-20 ml-2 rounded-md" required>
            </div>

            {{-- ACTIVE CLASSOOMS IDs --}}
            <select name="classroom_id"
                class="bg-gray-100 text-gray-700 border border-gray-200 focus:outline-none focus:bg-white focus:border-gray-500 w-64 h-11 m-2 rounded-md"
                required>

                <option disabled selected value> -- Séléctionnez une classe -- </option>

                <option value=""> - </option>

                @foreach ($activeClassrooms as $year => $classroom)
                    <option value="{{ $classroom->id }}" @selected($classroom->id == old('classroom_id'))>
                        {{ $classroom->classType->name }} </option>
                @endforeach

            </select>

            <button type="submit" class="btn-action btn-fill-create"> Ajouter </button>
        </div>
    </form>

    <x-validation-error-message name="name" />
    <x-validation-error-message name="capacity_min" />
    <x-validation-error-message name="capacity_max" />
    <x-validation-error-message name="classroom_id" />
</div>
