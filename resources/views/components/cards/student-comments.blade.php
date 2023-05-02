@props(['student'])

<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>

    <h3 class="w-full text-lg text-blue-500"> Commentaires </h3>

    <div class="flex-1 max-h-80 p-2 overflow-y-auto">

        @foreach ($student->comments as $comment)
            <div
                class="mb-1 p-1 border text-gray-700 hover:text-black border-gray-200 rounded-md hover:border-gray-100 hover:shadow">

                <div class="">
                    {{ $comment->content }}
                </div>

                <div class="flex items-center text-sm font-semibold text-blue-400">
                    <x-icons.user-circle />
                    <div>
                        <div class="text-sm"> {{ $comment->user->name }} </div>
                    </div>
                </div>

                <div class="text-gray-500 text-xs">
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <form action="{{ route('student-comments.store') }}" method="POST">

            <div class="grid grid-cols-4 items-end gap-2 p-1">

                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <textarea name="content" cols="30" rows="3"
                    class="col-span-full resize-none appearance-none block bg-gray-100 text-gray-700 border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none p-2 rounded leading-tight"
                    required>{{ old('content') }}</textarea>

                <div class="col-span-full">
                    <x-validation-error-message name="content" />
                </div>

                <button type="submit" class="btn-action btn-border-create-alt"> Commenter </button>

            </div>
        </form>
    </div>

</div>
