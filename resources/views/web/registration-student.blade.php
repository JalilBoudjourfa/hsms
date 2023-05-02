@extends('layouts.template-web')
@section('body')
    <div class="w-full min-h-screen">
        <div class="max-w-screen-lg m-auto pb-5 border-2">
            <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/building.JPG') }}')">
                <div class="relative w-full h-full backdrop-blur-sm bg-blue-500/30 flex items-center pb-5">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="w-24 p-2 bg-white rounded-b-lg ml-2 shadow-xl">
                    <h1
                        class="text-center text-white text-4xl font-semibold absolute inset-x-0 m-auto bg-black/30 w-fit p-2">
                        EL-HAYAT SCHOOL</h1>
                </div>
            </div>

            @if (session()->has('success'))
            <div class="flex justify-center flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-up-filled"
                    width="200" height="200" viewBox="0 0 24 24" stroke-width="2" stroke="#16a34a"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3"
                        fill="#FFF"></path>
                </svg>

                <span class="text-2xl font-semibold uppercase">Merci</span>
            </div>
            @else
                <form action="{{ route('web.store.student', $family) }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-5">

                        <span class="w-full bg-blue-500 text-white py-5 text-xl font-bold px-5">Votre Enfant</span>

                        <div class="px-2 grid grid-cols-1 gap-y-5">

                            <div class="grid grid-cols-2 gap-5">

                                <input type="text" name="family_id" value="{{ $family->id }}" class="hidden">

                                <x-forms.input-web type="text" name="fname" required>
                                    <x-slot:label_text>
                                        Prénom
                                    </x-slot:label_text>
                                </x-forms.input-web>

                                <x-forms.input-web type="text" name="lname" required>
                                    <x-slot:label_text>
                                        Nom
                                    </x-slot:label_text>
                                </x-forms.input-web>

                                <x-forms.input-web type="text" name="ar_fname" required>
                                    <x-slot:label_text>
                                        اللقب
                                    </x-slot:label_text>
                                </x-forms.input-web>

                                <x-forms.input-web type="text" name="ar_lname" required>
                                    <x-slot:label_text>
                                        الاسم
                                    </x-slot:label_text>
                                </x-forms.input-web>

                            </div>

                            <div class="grid grid-cols-4 gap-5">

                                <x-forms.input-web name="bday" type="date" min="{{ config('rules.bday.min') }}"
                                    class="col-span-1" max="{{ config('rules.bday.max') }}" required>
                                    <x-slot:label_text>
                                        Date de naissance
                                    </x-slot:label_text>
                                </x-forms.input-web>


                                <x-forms.input-web name="bplace" type="text" class="col-span-3" required>
                                    <x-slot:label_text>
                                        Lieu de naissance
                                    </x-slot:label_text>
                                </x-forms.input-web>

                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <x-forms.input-web type="text" name="nationality" required>
                                    <x-slot:label_text>
                                        Nationalité
                                    </x-slot:label_text>
                                </x-forms.input-web>

                                <div class=" mt-2 flex items-center">
                                    Garcon <input type="radio" name="sex" value="male" required class="mr-2">
                                    Fille <input type="radio" name="sex" value="female" required class="mr-2">
                                </div>

                            </div>

                            <span>Selectionner le niveau d'inscription</span>
                            <x-forms.select-active-classrooms required />
                        </div>

                        <div class="px-2 grid grid-cols-1 gap-y-5 bg-gray-200 pb-2">
                            <span class="w-full bg-blue-500 text-white py-5 text-xl font-bold px-5">L'ancien niveaux </span>

                            <div class="grid grid-cols-1 gap-5 px-2">

                                <div class="grid grid-cols-2 gap-5 items-center">

                                    <x-forms.input-web type="text" name="establishment_name">
                                        <x-slot:label_text>
                                            Nom de l'ancien établissement
                                        </x-slot:label_text>
                                    </x-forms.input-web>


                                    <x-forms.input-web type="text" name="ex_est_wilaya">
                                        <x-slot:label_text>
                                            Lieu de l'ancien établissement
                                        </x-slot:label_text>
                                    </x-forms.input-web>


                                </div>

                                <div class="grid grid-cols-2 gap-5 items-center">

                                    <x-forms.select-old-classrooms />

                                    <div class=" mt-2 flex space-x-5 items-center">

                                        <div>
                                            <span> Privé </span>
                                            <input type="radio" name="establishment_type" value="privet" class="">
                                        </div>

                                        <div>
                                            <span> public </span>
                                            <input type="radio" name="establishment_type" value="public" class="">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-5 mt-10">

                            <button type="submit" name="action" value="submit_and_refresh"
                                class="bg-blue-500 w-1/3 m-auto py-2 px-7 rounded-lg text-white text-xl shadow-blue-500 shadow hover:shadow-lg hover:bg-blue-700 shover:hadow-blue-700 hover:-translate-y-2 transition-all duration-200">Ajouter
                                Un autre Enfant +
                            </button>

                            <button type="submit" name="action" value="submit"
                                class="bg-green-500 w-1/3 m-auto py-2 px-7 rounded-lg text-white text-xl shadow-green-500 shadow hover:shadow-lg hover:bg-green-700 hover:shadow-green-700 hover:-translate-y-2 transition-all duration-200">
                                Terminer
                            </button>

                        </div>

                    </div>

                </form>
            @endif

        </div>

    </div>
@endsection
