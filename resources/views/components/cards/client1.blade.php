<div class="m-2 p-2">

    <h3 class="w-full text-xl"> {{ $card_heading }} </h3>

    <div class="ml-1 p-1">
        <span class="font-bold"> {{ $client_data->user->name }} </span>
    </div>

    <div class="ml-2 p-1">
        Profession: <span class="text-gray-700 text-sm"> {{ $client_data->profession }} </span>
    </div>

    <div class="ml-2 p-1">
        Téléphone:
        <a href="tel:{{ $client_data->user->primaryPhone?->number }}" class="text-blue-500 font-semibold underline">
            {{ $client_data->user->primaryPhone?->number }}
        </a>
    </div>

    <div class="ml-2 p-1">
        Domicile:
        <a href="tel:{{ $client_data->home_num }}" class="text-blue-500 font-semibold underline">
            {{ $client_data->home_num }}
        </a>
    </div>

    <div class="ml-2 p-1">
        whatsapp:
        <a href="tel:{{ $client_data->whatsapp }}" class="text-blue-500 font-semibold underline">
            {{ $client_data->whatsapp }}
        </a>
    </div>

    <div class="ml-2 p-1">
        Email:
        <a href="mailto:{{ $client_data->user->email }}?subject={{ config('app.CLIENT_NAME') }}"
            class="text-blue-500 font-semibold underline">
            {{ $client_data->user->email }}
        </a>
    </div>

    <div class="ml-2 p-1">
        Addresse: <span class="text-gray-700 text-sm"> {{ $client_data->address }} </span>
    </div>

    {{-- <div class="ml-2 p-1">
        Numéro de la carte nationale: <span class="text-gray-700 text-sm"> {{ $client_data->cni }} </span>
    </div> --}}

    {{ $slot }}

</div>
