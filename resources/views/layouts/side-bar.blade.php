<aside x-data="{ visible: true }" x-show="visible" x-transition x-on:open-sidebar.window="visible = true"
    x-on:close-sidebar.window="visible = false"
    class="absolute lg:static z-20 flex flex-col bg-[#081b4b] h-screen w-72 shadow-md ">

    {{-- LOGO --}}
    <div class="p-4 m-2 flex flex-wrap items-center space-x-2 ">
        <x-application-logo class="w-20 h-20 text-white" />
        <div class="text-white text-xl font-bold flex-1">
            El-Hayat School
        </div>
        <div class="flex justify-end">
            <div x-data x-on:click="$dispatch('close-sidebar')"
                class="h-8 aspect-square text-white cursor-pointer hover:bg-[#0069ff] rounded-lg">
                <x-icons2.chevron-double-left />
            </div>
        </div>
    </div>

    <hr class="mx-5 border-gray-500">

    <nav class="flex-1 overflow-auto p-2">

        <x-nav.simple-anchor href="{{ route('home') }}">
            <x-icons.home />
            <x-slot:label> Acceuil </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('dashboard') }}">
            <x-icons.view-grid />
            <x-slot:label> Dashboard </x-slot:label>
        </x-nav.simple-anchor>

        <hr class="mx-5 border-gray-500">

        <x-nav.simple-anchor href="{{ route('establishments.index') }}">
            <x-icons.office-building />
            <x-slot:label> Etablisments </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('establishment-years.index') }}">
            <x-icons.calendar />
            <x-slot:label> Années scolaires </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.active-years />

        <x-nav.simple-anchor href="{{ route('families.index') }}">
            <x-icons.user-group />
            <x-slot:label> Les familles </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('students.index') }}">
            <x-icons.user />
            <x-slot:label> Les élèves </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('clients.index') }}">
            <x-icons.users />
            <x-slot:label> Les parents </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('student-interviews.index') }}">
            <x-icons.list />
            <x-slot:label> Entretiens à venir </x-slot:label>
        </x-nav.simple-anchor>

        <x-nav.simple-anchor href="{{ route('expenses.index') }}">
            <x-icons.list />
            <x-slot:label> Gestion des frais </x-slot:label>
        </x-nav.simple-anchor>
    </nav>

    <div
        class="bg-gray-900 text-white bottom-0 left-0 w-full h-16 py-2 px-4 rounded-t-3xl flex items-center justify-between">

        <div class="flex items-center cursor-pointer">
            <x-icons.user-circle />
            <div class="ml-2">
                <div class="text-sm"> {{ Auth::user()->name }} </div>
                <div class="text-xs"> {{ Auth::user()->email }} </div>
            </div>
        </div>

        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="cursor-pointer">
                    <x-icons.logout />
                </button>
            </form>
        </div>

    </div>
</aside>
