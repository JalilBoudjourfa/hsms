@props(['interview'])

<div {{ $attributes->merge(['class' => 'p-2 shadow-md rounded-lg flex flex-col']) }}>

    <div class="flex-1">

        <h3 class="w-full text-xl"> {{ $interview->title }} <br> {{ $interview->schedule }}
            {{ $interview->conclusion === 'positive' ? '👍' : ($interview->conclusion === 'negative' ? '👎' : '📅') }}
        </h3>

        <div class="p-1">
            <span class="font-bold text-blue-500"> {{ $interview->schedule->diffForHumans() }} </span>
        </div>

        <div class="ml-1 p-1">
            <span class=""> Intérogateur: <span class="font-bold"> {{ $interview->interrogators }}
                </span>
        </div>

        <div class="ml-1 p-1">
            <span class=""> Participants: <span class="font-bold">
                    @if ($interview->father)
                        Pére,
                    @endif
                    @if ($interview->mother)
                        Mére,
                    @endif
                </span>
        </div>

        <div class="text-gray-700 mt-2 ml-2 p-1 text-sm">
            "{!! nl2br(htmlspecialchars($interview->note)) !!}"
        </div>

    </div>

    <div>
        {{ $slot }}
    </div>

    <div class="flex items-center">
        <a href="{{ route('student-interviews.edit', ['student_interview' => $interview->id]) }}"
            title="Modifier ou voir plus de detai" class="btn-nav btn-border-update-alt">
            <x-icons.pencil />
        </a>
    </div>

</div>
