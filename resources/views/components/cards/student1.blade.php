@props(['student'])

<div {{ $attributes->merge(['class' => 'p-2 shadow-md rounded-lg flex flex-col']) }}>

    <h3 class="w-full text-xl"> {{ $card_heading ?? '' }} </h3>

    <div class="flex-1">


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
            Email:
            <a href="mailto:{{ $student->user->email }}?subject={{ config('app.CLIENT_NAME') }}"
                class="text-blue-500 font-semibold underline">
                {{ $student->user->email }}
            </a>
        </div>

        <div class="ml-2 p-1">
            La derniere inscription: <span class="font-bold">
                {{ $student->latestRegistration->classroom->classType->name }} (
                {{ $student->latestRegistration->status }} ) </span>
        </div>

        @if ($student->latestRegistration->exRegistration != null)
            <div class="ml-4 p-1 text-sm">
                L'ancienne classe:
                {{ $student->latestRegistration->exRegistration->classType->alias }}
                à
                {{ $student->latestRegistration->exRegistration->establishment_name }}
                ({{ strtolower($student->latestRegistration->exRegistration->establishment_type) }})
                ({{ strtoupper($student->latestRegistration->exRegistration->ex_est_wilaya) }})
            </div>
        @endif

    </div>

    <div>
        {{ $slot }}
    </div>

</div>
