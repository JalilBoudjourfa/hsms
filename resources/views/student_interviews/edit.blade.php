<x-app-layout>

    <x-slot:header>
        <div class="mr-4">
            Entretien d'élève
        </div>

        <a href="{{ route('students.board', ['student' => $interview->studentRegistration->student->id]) }}"
            title="voir l'élève" class="btn-nav btn-fill-read">
            <x-icons.user />
        </a>

    </x-slot:header>

    <div class="grid grid-cols-12 gap-4">

        <x-cards.inner-card class="col-span-5">
            <x-cards.student-interview :interview="$interview" class="h-full" />
        </x-cards.inner-card>

        <x-cards.inner-card class="col-span-3">

            <form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }}
                method="post" class="h-full">

                @csrf
                @method('patch')
                <div class=" flex flex-col h-full">

                    <textarea name="note" cols="30" rows="3"
                        class="col-span-full bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none flex-1 resize-none p-2 appearance-none rounded">{{ $interview->note }}</textarea>

                    <br>
                    <button type="submit" class="btn-action btn-border-update-alt"> Sauvegarder </button>
                </div>
            </form>

        </x-cards.inner-card>

        <x-cards.inner-card class="col-span-4">
            <x-cards.student1 :student="$interview->studentRegistration->student" class="h-full" />
        </x-cards.inner-card>

        {{-- ! no edit when had conclusion --}}
        <x-cards.inner-card class="col-span-4">
            <form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }}
                method="post">

                @csrf
                @method('patch')

                <input name="schedule" type="datetime-local" value="{{ $interview->schedule->format('o-m-d\Th:i') }}"
                    required
                    class="appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none w-full p-2 rounded leading-tight">

                <br>
                <button type="submit" class="btn-action btn-border-update-alt"> Mèttre à jour </button>
            </form>

        </x-cards.inner-card>

        {{-- ! no edit when had conclusion --}}
        <x-cards.inner-card class="col-span-4">
            <form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }}
                method="post">

                @csrf
                @method('patch')

                <label for="participants"> Participants: </label>
                <div class="col-span-full mt flex items-center justify-center">
                    <div class="col-span-full mt flex items-center justify-center">
                        Père <input type="checkbox" name="father" value="{{$interview->father}}" @checked($interview->father == true) class="mr-2">
                        Mère <input type="checkbox" name="mother" value="{{$interview->mother}}" @checked($interview->mother == true) class="mr-2">
                    </div>
                </div>

                <br>
                <button type="submit" class="btn-action btn-border-update-alt"> Mèttre à jour </button>


            </form>
        </x-cards.inner-card>

        <x-cards.inner-card
            class="col-span-4 {{ $interview->conclusion == 'positive' ? 'bg-green-50' : ($interview->conclusion == 'negative' ? 'bg-red-50' : 'bg-white') }}">

            <h3 class="text-lg"> Conclusion: </h3>

            <form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }}
                method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="conclusion" value="positive">
                <button type="submit" class="btn-action"> ✔️ </button>
            </form>

            <form action={{ route('student-interviews.update', ['student_interview' => $interview->id]) }}
                method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="conclusion" value="negative">
                <button type="submit" class="btn-action"> ❌ </button>
            </form>

            {{-- RESET --}}
            {{-- NEUTRAL --}}

        </x-cards.inner-card>


    </div>

</x-app-layout>
